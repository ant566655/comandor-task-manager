<div id="description" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Добавить задачу:</h5>
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
                        <input type="number" class="form-control" id="task_price"/>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" value="add"/>
                        <button type="submit" name="action_button" id="action_button" class="btn btn-danger" value="add">Добавить</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </form>
            </div>

            <div id="form-error" class="form-error"></div>

        </div>
    </div>
</div>
