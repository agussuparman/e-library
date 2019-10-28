<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Book;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\BorrowLog;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\BookException;
use Excel;
use PDF;
use Validator;
use App\Author;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $books = Book::with('author');
            return Datatables::of($books)
                ->addColumn('action', function($book) {
                    return view('datatable._action', [
                        'model' => $book,
                        'form_url' => route('books.destroy', $book->id),
                        'edit_url' => route('books.edit', $book->id),
                        'confirm_message' => 'Yakin ingin menghapus ' . $book->title . '?'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'title', 'name' => 'title', 'title' => 'Judul'])
            ->addColumn(['data' => 'amount', 'name' => 'amount', 'title' => 'Jumlah'])
            ->addColumn(['data' => 'author.name', 'name' => 'author.name', 'title' => 'Penulis'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false]);

        return view('books.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->only('title', 'author_id', 'amount');

        if ($request->hasFile('cover')) {
            $data['cover'] = $this->saveCover($request->file('cover'));
        }

        $book = Book::create($data);

        Session::flash('flash_notification', [
            "level" => "success",
            "message" => "Berhasil menyimpan $book->title"
        ]);

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $data = $request->only('title', 'author_id', 'amount');
        $book = Book::findOrFail($id);

        if ($request->hasFile('cover')) {
            $data['cover'] = $this->saveCover($request->file('cover'));
            if ($book->cover !== '') $this->deleteCover($book->cover);
        }

        // $book->update($data);
        if (!$book->update($data)) return redirect()->back();

        Session::flash('flash_notification', [
            "level" => "success",
            "message" => "Berhasil menyimpan $book->title"
        ]);

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book->delete()) return redirect()->back();
        if ($request->ajax()) return response()->json(['id' => $id]);
        if ($book->cover !== '') $this->deleteCover($book->cover);
        $book->delete();

        Session::flash('flash_notification', [
            "level" => "success",
            "message" => "Buku berhasil dihapus"
        ]);

        return redirect()->route('books.index');
    }

    protected function saveCover(UploadedFile $cover)
    {
        $fileName = md5(time()) . '.' . $cover->guessClientExtension();
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        $cover->move($destinationPath, $fileName);
        return $fileName;
    }

    protected function deleteCover($fileName)
    {
        $path = public_path() . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $fileName;
        return File::delete($path);
    }

    public function borrow($id)
    {
        try {
            $book = Book::findOrFail($id);
            Auth::user()->borrow($book);
            Session::flash('flash_notification',[
                "level" => "success",
                "message" => "Berhasil meminjam $book->title"
            ]);
        } catch (BookException $e) {
            Session::flash('flash_notification', [
                "level" => "danger",
                "message" => $e->getMessage()
            ]);
        }
        catch (ModelNotFoundException $e) {
            Session::flash('flash_notification', [
                "level" => "danger",
                "message" => "Buku tidak ditemukan"
            ]);
        }

        return redirect('/');
    }

    public function returnBack($id)
    {
        $borrowLog = BorrowLog::where('user_id', Auth::user()->id)
            ->where('book_id', $id)
            ->where('is_returned', 0)
            ->first();

        if ($borrowLog) {
            $borrowLog->is_returned = true;
            $borrowLog->save();
        }

        Session::flash('flash_notification', [
            "level" => "success",
            "message" => "Berhasil mengembalikan " . $borrowLog->book->title
        ]);

        return redirect('/home');
    }

    public function export()
    {
        return view('books.export');
    }

    public function exportPost(Request $request)
    {
        $this->validate($request,[
            'author_id' => 'required',
            'type' => 'required|in:xls,pdf'
        ], [
            'author_id.required' => 'Anda belum memilih judul. Pilih minimal 1 penulis.'
        ]);

        $books = Book::whereIn('id', $request->get('author_id'))->get();
        $handler = 'export' . ucfirst($request->get('type'));
        return $this->$handler($books);
    }

    private function exportXls($books)
    {
        Excel::create('Data Buku E-Library', function($excel) use ($books) {
            $excel->setTitle('Data Buku E-Library')
                ->setCreator(Auth::user()->name);
            $excel->sheet('Data Buku', function($sheet) use ($books) {
                $row = 1;
                $sheet->row($row, [
                    'Judul',
                    'Jumlah',
                    'Stok',
                    'Penulis'
                ]);
                foreach ($books as $book) {
                    $sheet->row(++$row, [
                        $book->title,
                        $book->amount,
                        $book->stock,
                        $book->author->name
                    ]);
                }
            });
        })->export('xls');
    }

    private function exportPdf($books)
    {
        $pdf = PDF::loadview('pdf.books', compact('books'));
        return $pdf->download('books.pdf');
    }

    public function generateExcelTemplate()
    {
        Excel::create('Template Import Buku', function($excel) {
            $excel->setTitle('Template Import Buku')
                ->setCreator('E-Library')
                ->setCompany('E-Library')
                ->setDescription('Template import buku untuk E-Library');

            $excel->sheet('Data Buku', function($sheet) {
                $row = 1;
                $sheet->row($row, [
                    'judul',
                    'penulis',
                    'jumlah'
                ]);
            });
        })->export('xlsx');
    }

    public function importExcel(Request $request)
    {
        $this->validate($request, [
            'excel' => 'required|mimes:xls,xlsx'
        ]);

        $excel = $request->file('excel');
        $excels = Excel::selectSheetsByIndex(0)->load($excel, function($reader) {
        })->get();

        $rowRules = [
            'judul' => 'required',
            'penulis' => 'required',
            'jumlah' => 'required'
        ];

        $books_id = [];

        foreach ($excels as $row) {
            $validator = Validator::make($row->toArray(), $rowRules);
            if ($validator->fails()) continue;

            $author = Author::where('name', $row['penulis'])->first();
            if (!$author) {
                $author = Author::create(['name' => $row['penulis']]);
            }

            $book = Book::create([
                'title' => $row['judul'],
                'author_id' => $author->id,
                'amount' => $row['jumlah']
            ]);

            array_push($books_id, $book->id);
        }

        $books = Book::whereIn('id', $books_id)->get();

        if ($books->count() == 0) {
            Session::flash('flash_notification', [
                "level" => "danger",
                "message" => "Tidak ada buku yang berhasil diimport."
            ]);
            return redirect()->back();
        }

        Session::flash('flash_notification', [
            "level" => "success",
            "message" => "Berhasil mengimport " . $books->count() . " buku"
        ]);

        return view('books.import-review')->with(compact('books'));
    }
}
