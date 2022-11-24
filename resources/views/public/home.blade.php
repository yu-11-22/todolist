@extends('layout.frontend')

@section('title', '首頁')

@section('header')
<div class="composing">
    <a href="/">
        <h1>Todo List</h1>
    </a>
    <div>
        <span class="mr-3">使用者： {{Auth::guard('user')->user()->account}}</span>
        <a href="logout">
            登出
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="home">
    <div class="row upper mt-5">
        <div class="add">
            <button class="btn-dark" type="button" onclick="showAddForm()">新增事項</button>
            <div id="addForm" class="addForm">
                <form action="/add" method="post">
                    @csrf
                    <div class="add-content">
                        <div class="mt-5">
                            新增事項：<input type="text" name="task" required>
                        </div>
                        <div class="mt-5" style="display: flex;">
                            <span>事項記錄：</span>
                            <textarea name="description" cols="30" rows="6" style="resize:none;"></textarea>
                        </div>
                        <div class="mt-5">
                            預計執行日：<input type="date" name="operate_at" required>
                        </div>
                        <div class="mt-4">
                            預計完成日：<input type="date" name="complete_at" required>
                        </div>
                        <div class="mt-5">
                            <button class="btn-dark mr-5" type="submit">新增</button>
                            <button class="btn-dark ml-5" type="button" onclick="hideAddForm()">關閉</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="search">
            <form action="home" method="get">
                <input type="text" name="search" value="">
                <button class="btn-dark" type="submit">搜尋</button>
            </form>
        </div>
    </div>
    <div class="list mt-5">
        <table class="mx-auto">
            <thead>
                <tr>
                    <td width="5%">編號</td>
                    <td width="20%">待辦事項</td>
                    <td width="25%">事項記錄</td>
                    <td width="12%">預計執行時間</td>
                    <td width="12%">預計完成時間</td>
                    <td width="8%">延誤時間</td>
                    <td width="8%">
                        <div class="btn-group">
                            <button type="button" class="dropdown-toggle btn" data-toggle="dropdown">
                                狀態
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">待執行</a>
                                <a class="dropdown-item" href="#">執行中</a>
                                <a class="dropdown-item" href="#">已完成</a>
                            </div>
                        </div>
                    </td>
                    <td width="10%">操作</td>
                </tr>
            </thead>
            <tbody>
                @if (count($list) > 0)
                @foreach($list as $key => $val)
                <tr>
                    <td>{{$count += 1}}</td>
                    <td>{{$val->task}}</td>
                    <td>{{$val->description}}</td>
                    <td>{{$val->operate_at}}</td>
                    <td>{{$val->complete_at}}</td>
                    <td>{{$delay}} 天</td>
                    <td>執行中</td>
                    <td>
                        <a href="#" class="mr-1">
                            <i class='fas fa-edit'></i>
                        </a>
                        <a href="#" class="ml-1">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="8" style="height: 50vh; font-size: 5rem;">尚未新增任何待辦事項!!</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
