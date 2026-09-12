<article @php(post_class('h-entry'))>
  <div class="display-content">
    <h1 class="text-center mb-3 pt-10 lg:pt-20">{{the_title()}}</h1>
    @php(the_content())
  </div>
</article>
