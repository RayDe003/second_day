<?php

namespace Controller;

use Illuminate\Database\Capsule\Manager as DB;
use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Src\Validator\Validator;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }


//    public function hello(): string
//    {
//        return new View('site.hello', ['message' => 'привет боба хихи ты админ кста']);
//    }

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

    public function libAdd(): string{
        return new View('site.libAdd');
    }

    public function readers(): string{
        return new View('site.readers');
    }

    public function books(): string{
        return new View('site.books');
    }

    public function out(): string{
        return new View('site.out');
    }
}
