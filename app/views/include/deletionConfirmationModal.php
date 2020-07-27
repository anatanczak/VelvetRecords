<!-- Modal -->
<div class="modal fade" id="deletionConfirmationModal" tabindex="-1"
     role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Etes-vous sûr de vouloir supprimer le disc <em><?php if(isset
                    ($cd->disc_title)){echo $cd->disc_title;} ?></em>  de
                la
                base de
                donné ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Annuler</button>
                <a id="confirm-deletion-btn" href="<?= URLROOT .
                'cds/remove/' . $cd->disc_id?>" class="btn
                btn-primary">Supprimer</a>
            </div>
        </div>
    </div>
</div>