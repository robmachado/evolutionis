<div id="DeleteModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <!---<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <h2 class="modal-title text-center">CONFIRM</h2>
                </div>
                <div class="modal-body">
                    @csrf
                    @method("delete")
                    <p class="text-center">Confirma a remoção do registro ?</p>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancela</button>
                        <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Sim, Remova</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>
