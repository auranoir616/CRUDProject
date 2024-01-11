

<footer>
    <hr>
      <div>
        {{ $alldata->appends(['page' => $alldata->currentPage()])->links('pagination::bootstrap-4') }}  
      </div>
    </footer>
  