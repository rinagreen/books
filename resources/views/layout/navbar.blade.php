<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
   <a class="navbar-brand" href="/">Queens Library</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarsExample03">
      <ul class="navbar-nav mr-auto">
         <li class="nav-item">
            <a class="nav-link" href="/">Home 
               <span class="sr-only">(current)</span>
            </a>
         </li>
         <li class="nav-item {{ \Request::is('books') ? 'active' : '' }}" >
            <a class="nav-link" href="/books">Books</a>
         </li> 
         <li class="nav-item {{ \Request::is('authors') ? 'active' : '' }}" >
            <a class="nav-link" href="/authors">Authors</a>
         </li> 
      </ul> 
   </div>
</nav>