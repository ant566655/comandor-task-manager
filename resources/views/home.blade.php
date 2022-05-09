@extends('layouts.app')

@section('content')

    <div class="container mt-1">
        <div class="m-1">
            <button type="button" id="create" class="btn btn-info">Новая задача..</button>
        </div>
        <div class="container-fluid">
            <table id="datatablesSimple" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%; table-layout: auto;">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Задача</th>
                    <th>Описание</th>
                    <th>Стоимость</th>
                    <th>Подрядчик</th>
                    <th>Срок</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
            </table>

        </div>

        <!-- Модальные окна -->
        @include('modal.task_add')
        @include('modal.task_edit')
        @include('modal.task_close')

    <script type="text/javascript">
        $(function () {
            $('#datatablesSimple').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('task.index')}}',

                columns: [
                    {data: 'id', name: 'id', class: 'text-center', width: 'auto'},
                    {data: 'task', name: 'task', },
                    {data: 'description', name: 'description', },
                    {data: 'price', name: 'price', },
                    {data: 'executor', name: 'executor', },
                    {data: 'date', name: 'date', },
                    {data: 'status', name: 'status', },
                    {data: 'action', name: 'action', class: 'text-center', orderable:false, searchable: false}
                ]
            });

        });
        $('#create').click(function (){
            $('#description').modal('show');
        });
        $('#task_form').on('submit', function (event){
            event.preventDefault();
            var action_url = '';
            if ($('#action').val() === 'add')
            {
                action_url = "{{route('task.store')}}";
            }
            $.ajax({
                url: action_url,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data)
                {
                    var html ='';
                    if (data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#task_form')[0].reset();
                        $('#datatablesSimple').DataTable().ajax.reload();
                    }
                    $('#result').html(html);
                }
            })
        });
    </script>
@endsection
