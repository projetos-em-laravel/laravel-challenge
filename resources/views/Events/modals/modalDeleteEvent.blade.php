<!-- Modal -->
<div class="modal fade" id="deleteEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Delete event</h4>
            </div>
            <div class="modal-body">
                <h3>Do you really want to delete the <i id="title"></i> event?</h3>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                <form>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="btn btn-danger deleteEventInModal" data-dismiss="modal">Delete event</button>
                </form>
            </div>
          </div>
        </div>
      </div>