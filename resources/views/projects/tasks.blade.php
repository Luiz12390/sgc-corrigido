@extends('layouts.app')

@section('title', 'Tarefas do Projeto | SGC-Chapecó')

@section('content')
    @livewire('project-tasks', ['project' => $project])
@endsection
