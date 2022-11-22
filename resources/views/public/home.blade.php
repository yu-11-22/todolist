@extends('layout.frontend')

@section('title', '首頁')

@section('header')
<div class="composing">
    <a href="/">
        <h1>Todo List</h1>
    </a>
    <a href="logout">
        登出
    </a>
</div>
@endsection

@section('content')
<div class="home">
    <div class="row search add mt-3">
        <div>
            <form action="home" method="post">
                <button class="btn-dark" type="submit">新增事項</button>
            </form>
        </div>
        <div>
            <form action="home" method="get">
                <input type="text" name="search">
                <button class="btn-dark" type="submit">搜尋</button>
            </form>
        </div>
    </div>
    <div class="list mt-4">
        <table class="mx-auto">
            <thead>
                <tr>
                    <td width="10%">編號</td>
                    <td width="60%">待辦事項</td>
                    <td width="15%">新增時間</td>
                    <td width="15%">操作</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@endsection