<!-- Modal -->
<div class="modal fade" id="newSend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send invitation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <ul class="list-group">
                    <li class="list-group-item active"><h4>Title: <span id="titleSend"></span></h4> </li>
                    <li class="list-group-item">Description: <i id="descriptionSend"></i></li>
                    <li class="list-group-item">Start event: <i id="startDateSend"></i> at <i id="startTimeSend"></i></li>
                    <li class="list-group-item">End event: <i id="endDateSend"></i> at <i id="endTimeSend"></i> </li>
                </ul>

                <form>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" rows="5" class="form-control" required>
                    </div> 
                    <div class="form-group">
                        <label for="emailBody">Email body:</label>
                        <textarea name="emailBody" id="emailBody" rows="5" class="form-control" required></textarea>
                    </div> 
                </form>       
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if(isset($eventAll))
                    <button class="btn btn-primary sendEmail" data-title='{{$eventAll->title}}' data-description='{{$eventAll->description}}' data-startdate='{{$eventAll->start_date}}' data-starttime='{{$eventAll->start_time}}' data-enddate='{{$eventAll->end_date}}' data-endtime='{{$eventAll->end_time}}'>Send invitation</button>
                @endif
            </div>
        </div>
    </div>
</div>

