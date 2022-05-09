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
        <div id="lock" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Подтвердите действие</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="m-3">
                            <label for="recipient-name" class="col-form-label">Исполнитель:</label>
                            <input type="text" class="form-control" id="recipient-name"
                                   value="{{ Auth::user()->name }}"
                                   readonly>
                        </div>
                        <div class="m-3">
                            <label for="due_date" class="col-form-label">Срок выполнения:</label>
                            <input id="due_date" type="date" name="date" class="form-control" required>
                        </div>
                    </form>
                    <div id="form-error" class="form-error"></div>
                    <div class="modal-footer">
                        <button type="button" id="btn_lock" class="btn btn-info">Заблокировать</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="unlock" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Подтвердите действие</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="m-3">
                            <label for="recipient-name" class="col-form-label">
                                Вы уверены что хотите разблокировать задачу?
                            </label>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" id="btn_unlock" class="btn btn-info">Разблокировать</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="description" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Способ оплаты выполненных работ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="m-3">
                        <span id="result"></span>
                        <form method="post" id="task_form" class="form-horizontal">
                            @csrf
                            <div class="m-3">
                                <label>Название</label>
                                <input type="text" class="form-control" id="task_name"/>
                            </div>
                            <div class="m-3">
                                <label>Описание задачи</label>
                                <textarea  class="form-control" id="task_description" rows="6"></textarea>
                            </div>
                            <div class="m-3">
                                <label>Стоимость</label>
                                <input type="text" class="form-control" id="task_price"/>
                            </div>
                            <div >
                                <input type="hidden" name="action" id="action" value="add"/>
                                <input type="submit" name="action_button" id="action_button" class="btn btn-danger" value="add" />
                            </div>
                        </form>
                    </div>

                    <div id="form-error" class="form-error"></div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

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
