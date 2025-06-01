<div class="modal fade" id="{{$modalid}}" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div {{$attributes->merge(['class' => 'modal-dialog'])}} role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
             {{ $modal_body }}
          </div>
          <div class="modal-footer">
            {{ $modal_footer }}
            <button class="btn modal-close-btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
          </div>
      </div>
  </div>
</div>