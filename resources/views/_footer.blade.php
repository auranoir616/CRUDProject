
<footer class="footer">

      <div style="align-self: center">
        <hr>

        {{ $postdata->appends(['page' => $postdata->currentPage()])->links('pagination::bootstrap-4') }}  
      </div>
    </footer>
  