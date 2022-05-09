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
