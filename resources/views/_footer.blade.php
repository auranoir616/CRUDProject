
<footer>
      <div >
        @if(isset($postdata) && $postdata)
        {{$postdata->appends(['page' => $postdata->currentPage()])->links('pagination::bootstrap-4') }}  
        @else
        {{$allusers->appends(['page' => $allusers->currentPage()])->links('pagination::bootstrap-4') }} 
         @endif
      </div>
    </footer>
  