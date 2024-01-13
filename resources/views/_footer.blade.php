
<footer class="footer">
    <hr>
      <div style="align-self: center">
        {{ $alldata->appends(['page' => $alldata->currentPage()])->links('pagination::bootstrap-4') }}  
      </div>
    </footer>
  