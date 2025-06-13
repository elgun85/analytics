@extends('Page.layout.master')
@section('title', 'Todo List')

@section('content')
    <main id="main" class="main ">
        <div class="pagetitle">
            <h1>Todo List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Blank</li>
                </ol>
            </nav>
        </div>
        <section class="section mt-3">
<livewire:todo.todo-index/>
        </section>
    </main>
@endsection









