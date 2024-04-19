<?php

namespace Controller;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Support\Str;
use Model\Author;
use Model\Authors_books;
use Model\Book;
use Model\Bookinstance;
use Model\Reader;
use Model\ReadersBooks;
use Model\Status;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;

class Site
{
    public function newLibrarian(Request $request): string
    {
        $librarians = User::where('role', 2)->get();
        if ($request->method==='POST') {
            $validator = new Validator($request->all(), [
               'name' => ['required', 'symbols'],
               'surname' => ['required' , 'symbols'],
                'patronymic' => ['symbols'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'symbols' => 'Поле :field должно содержать символы кириллицы'
            ]);

            if($validator->fails()){
                return new View('site.hello',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);

            }

            if(User::create($request->all())){
                $librarians = User::where('role', 2)->get();
                return new View('site.hello' ,['message' => 'Ура успех', 'librarians'=>$librarians]);
            }
        }

        if ($request->method === 'GET' && $request->has('search')) {
            $search = $request->query('search');
            $librarian = User::where('name', 'like', '%' . $search . '%')
                ->orWhere('surname', 'like', '%' . $search . '%')
                ->orWhere('patronymic', 'like', '%' . $search . '%')
                ->where('role', 2)
                ->first();

            if ($librarian) {
                return (new View())->render('site.hello', ['librarian' => $librarian]);
            }
        }
        if ($request->method === 'GET' && $request->has('clear')) {
            $librarians = User::where('role', 2)->get();
            return (new View())->render('site.hello', ['librarians' => $librarians]);
        }


        return (new View())->render('site.hello', ['librarians' => $librarians]);
    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/libAdd');
        }

        if (Auth::checkAdmin()) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/login');
    }

    public function libAdd(Request $request): string
    {
        $authors = Author::all();

        if ($request->method==='POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required', 'symbols'],
                'surname' => ['required' , 'symbols'],
                'patronymic' => ['symbols'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'symbols' => 'Поле :field должно содержать символы кириллицы'
            ]);

            if($validator->fails()){
                return new View('site.libAdd',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);

            }

            if(Author::create($request->all())){
                return new View('site.libAdd' ,['message' => 'Ура успех']);
            }
        }

        return new View('site.libAdd', ['authors' => $authors]);
    }

    public function addBook(Request $request): string
    {
        $authors = Author::all();

        $validator = new Validator($request->all(), [
            'title' => ['required', 'symbols'],
            'year' => ['required' , 'numbers'],
            'price' => ['required','numbers'],
            'image' => ['image']
        ], [
            'required' => 'Поле :field пусто',
            'unique' => 'Поле :field должно быть уникально',
            'symbols' => 'Поле :field должно содержать символы кириллицы',
            'numbers' => 'Поле :field должно содержать только цифры',
            'image' => 'Поле :field должно быть изображением'
        ]);

        if($validator->fails()){
            return new View('site.libAdd',
                ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);

        }

        if ($request->method === 'POST') {
            $data = $request->all();
            $isNew = isset($data['is_new']) ? true : false;

            $image_path = $_FILES['image']['name'];
            $path = "/public/images/";
            $target_dir = $_SERVER['DOCUMENT_ROOT'] . $path;
            $target_file = $target_dir . basename($image_path);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            $book = Book::create([
                'title' => $data['title'],
                'year' => $data['year'],
                'price' => $data['price'],
                'is_new' => $isNew,
                'annotation' => $data['annotation'],
                'image' => "./public/images/$image_path"
            ]);

            Authors_books::create([
                'author_id' => $data['author_id'],
                'book_id' => $book->id
            ]);
        }

        return new View('site.libAdd', ['authors' => $authors]);

    }

    public function addReader(Request  $request): string
    {
        $authors = Author::all();

        $validator = new Validator($request->all(), [
            'name' => ['required', 'symbols'],
            'surname' => ['required' , 'symbols'],
            'address' => ['required'],
            'phone_number' => ['required','numbers']
        ], [
            'required' => 'Поле :field пусто',
            'unique' => 'Поле :field должно быть уникально',
            'symbols' => 'Поле :field должно содержать символы кириллицы',
            'numbers' => 'Поле :field должно содержать только цифры'
        ]);

        if($validator->fails()){
            return new View('site.libAdd',
                ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);

        }

        if(Reader::create($request->all())){
            return new View('site.libAdd' ,['message' => 'Ура успех']);
        }


        return new View('site.libAdd', ['authors' => $authors]);

    }


    public function readers(Request $request): string
    {
        $readers = Reader::all();
        $status = Status::all();

        if ($request->method === 'GET' && $request->has('search')) {
            $search = $request->query('search');
            $searchTerms = explode(' ', $search);

            $reader = Reader::where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('name', 'like', '%' . $term . '%')
                            ->orWhere('surname', 'like', '%' . $term . '%')
                            ->orWhere('patronymic', 'like', '%' . $term . '%')
                            ->orWhere('phone_number', 'like', '%' . $term . '%');
                    });
                }
            })->get();

            if ($reader->count() > 0) {
                return (new View())->render('site.readers', ['reader' => $reader, 'status' => $status]);
            }
        }

        if ($request->method === 'GET' && $request->has('clear')) {
            $readers = Reader::all();
            return (new View())->render('site.readers', ['readers' => $readers, 'status' => $status]);
        }

        if ($request->method === 'GET' && $request->has('reader_id')) {
            $readerId = $request->query('reader_id') + 1;
            $reader = Reader::find($readerId);
            if ($reader) {
                $books = Book::whereHas('bookInstances.readerBooks', function ($query) use ($readerId) {
                    $query->where('reader', $readerId);
                })->with(['bookInstances.readerBooks.status'])->get();
                return (new View())->render('site.readers', ['readers' => $readers, 'books' => $books, 'selectedReader' => $reader, 'status' => $status]);
            } else {
                return (new View())->render('site.readers', ['message' => 'Читатель не найден', 'status' => $status]);
            }
        }

        return (new View())->render('site.readers', ['readers' => $readers, 'status' => $status]);
    }


    public function changeStatus(Request $request): string{
        $readers = Reader::all();
        $status = Status::all();

        $readerBook = ReadersBooks::find($request->all()['readerBook_id']);


        if ($request->method === 'POST') {
            $data = $request->all();
            $chosenStatus = $data["status_id_$readerBook->id"];
            $readerBook->status_id = $chosenStatus;
            $readerBook->save();
        }


        return (new View())->render('site.readers', ['readers' => $readers, 'status' => $status]);

    }


    public function books(Request $request): string{
        $books = Book::all();

        if ($request->method === 'GET' && $request->has('search')) {
            $search = $request->query('search');
            $searchTerms = explode(' ', $search);

            $book = Book::where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('title', 'like', '%' . $term . '%');
                    });
                }
            })->get();

            if ($book->count() > 0) {
                return (new View())->render('site.books', ['book' => $book]);
            }
        }

        if ($request->method === 'GET' && $request->has('clear')) {
            $books = Book::all();
            return (new View())->render('site.books', ['books' => $books]);
        }

        if($request->method === 'GET' && $request->has('book_id')){
            $bookId = $request->query('book_id');
            $book = Book::find($bookId);
            if($book){
                $readers = Reader::whereHas('ReadersBooks.bookInstance', function ($query) use ($bookId) {
                    $query->where('book_id', $bookId);
                })->get();
                $selectedBookReadersCount = $readers->count();
                $otherBooksReadersCount = Reader::whereHas('ReadersBooks.bookInstance', function ($query) use ($bookId) {
                    $query->where('book_id', '!=', $bookId);
                })->get()->count();

                return(new View())->render('site.books', ['books' => $books, 'readers' => $readers, 'selectedBook' => $book, 'selectedBookReadersCount' => $selectedBookReadersCount,
                    'otherBooksReadersCount' => $otherBooksReadersCount]);
            }
            else {
                return (new View())->render('site.books', ['message' => 'нет']);
            }
        }

        return (new View())->render('site.books', ['books' => $books]);
    }

    public function out(Request $request): string{
        $books = Book::all();
        $readers = Reader::all();


        if ($request->method === 'GET' && $request->has('search')) {
            $search = $request->query('search');
            $searchTerms = explode(' ', $search);

            $book = Book::where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('title', 'like', '%' . $term . '%');
                    });
                }
            })->get();

            if ($book->count() > 0) {
                return (new View())->render('site.out', ['book' => $book, 'readers'=>$readers]);
            }
        }

        if ($request->method === 'GET' && $request->has('clear')) {
            $books = Book::all();
            return (new View())->render('site.out', ['books' => $books]);
        }



        if ($request->method === 'GET' && $request->has('search')) {
            $search = $request->query('search');
            $searchTerms = explode(' ', $search);

            $reader = Reader::where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('name', 'like', '%' . $term . '%')
                            ->orWhere('surname', 'like', '%' . $term . '%')
                            ->orWhere('patronymic', 'like', '%' . $term . '%')
                            ->orWhere('phone_number', 'like', '%' . $term . '%');
                    });
                }
            })->get();

            if ($reader->count() > 0) {
                return (new View())->render('site.out', ['reader' => $reader , 'books' => $books]);
            }
        }

        if ($request->method === 'GET' && $request->has('clear')) {
            $readers = Reader::all();
            return (new View())->render('site.out', ['readers' => $readers]);
        }

        return (new View())->render('site.out', ['readers' => $readers , 'books' => $books]);
    }

    public function getOut (Request $request): string
    {
        $books = Book::all();
        $readers = Reader::all();

        $data = $request->all();

        $validator = new Validator($request->all(), [
            'ISBN' => ['required'],
            'get_back' => ['required'],
        ], [
            'required' => 'Поле :field пусто',
        ]);

        if($validator->fails()){
            return new View('site.libAdd',
                ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);

        }

        if ($request->method === 'POST') {


            $bookInstance = Bookinstance::create([
                'book_id' => $data['selected_book_id'],
                'ISBN' => $data['ISBN']
            ]);


            $readersBooks = ReadersBooks::create([
                'get_back' => $data['get_back'],
                'book_instance' => $data['ISBN'],
                'librarian' => Auth::user()->id,
                'reader' => $data['selected_reader_id']
            ]);

            return (new View())->render('site.out', ['readers' => $readers , 'books' => $books]);
        }

        return (new View())->render('site.out', ['readers' => $readers , 'books' => $books]);
    }
}
