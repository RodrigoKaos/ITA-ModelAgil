<div class="book content">
  <div class="book info">
      
    <h1>{book.title}</h1>
    <div>{book.genre}</div>
    <div>{book.total_pages}</div>
    
    <form method="post">            
      <input type="hidden" name="book" value="{book.id}">
      <input type="hidden" name="status" value="{book.status}">
      <button type="submit" {book.str_status}>Já li!</button>        
    </form>
  </div>

</div>