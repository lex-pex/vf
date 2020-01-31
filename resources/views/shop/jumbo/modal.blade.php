@if(!session()->has('message_read'))
<div class="modal fade" id="myModal">
    <div class="modal-dialog text-center">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Доброго Дня!</h4>
                <button type="button" class="close" onclick="modalMessageRead()" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="font-size: 18px;font-weight: bold">
                НЕВЕЛИЧКА ПОРАДА:<br/>
                Спробуйте додати <br/>
                ТОВАРИ ДО КОШИКА,<br/>
                скористайтесь зручним<br/>
                калькулятором замовлень<br/>
                впевнетесь, як це насправдi<br/>
                НЕ ДОРОГО I ЗРУЧНО!
            </div>
            <div class="modal-footer">
                <button type="button" onclick="modalMessageRead()" class="btn btn-danger" data-dismiss="modal">Замкнути</button>
            </div>
        </div>
    </div>
</div>
<span style="display:none" id="modal_launcher" data-toggle="modal" data-target="#myModal"></span>
@endif
