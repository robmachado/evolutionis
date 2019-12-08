<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="" id="deleteForm" name="deleteForm" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Solicitação de Deleção</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @csrf
        @method("delete")
        <p class="text-center">Confirma a remoção do registro ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancela</button>
        <button type="button" class="btn btn-danger" onclick="formSubmit()">Sim, Remova o registro.</button>
      </div>
      </form>
    </div>
  </div>
</div>
