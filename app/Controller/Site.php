<?php

namespace Controller;

use Illuminate\Database\Capsule\Manager as DB;
use Model\Post;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

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
        if ($request->method==='POST' && User::create($request->all())) {
            echo 'Пользователь успешно зарегистрирован!';
        }
        return new View('site.hello');
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
