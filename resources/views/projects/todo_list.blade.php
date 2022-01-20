@extends('template')

@section('content')
    <div class="todolist-container">
        <h1>To-do List réalisée avec Vue.JS</h1>
        <div class="todolist">
            <button type="button" class="bouton"><a href="{{ route('portfolio') }}">Retour au portfolio</a></button>
            <div id="app">
                <div class="tasklist-container">
                    <task-form v-bind:task-list="taskList"></task-form>
                    
                    <!-- Affichage de la liste de tâches enregistrée par le composant -->
                    {{-- @{{taskList}} --}}
                                    
                    <hr>
                    <task-list v-bind:task-list="taskList"></task-list>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptjs')
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script type="module" src="{{ URL::asset('js/projects/todolist.js') }}"></script>
@endsection