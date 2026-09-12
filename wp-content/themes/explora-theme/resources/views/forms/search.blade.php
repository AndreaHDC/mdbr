<form role="search" method="get" class="search-form" action="{{ home_url('/') }}">

  <div class="search-form__field w-full relative">

    <label for="ricerca" class="sr-only">
      {{ _x('Search', 'label', 'sage') }}
    </label>

    <input
      id="ricerca"
      class="border border-black p-3 rounded-md w-full"
      type="search"
      placeholder="{!! esc_attr_x('Search', 'placeholder', 'sage') !!}"
      value="{{ get_search_query() }}"
      name="s"
      required
    >

  </div>

  <button
    type="submit"
    class="search-form__submit bg-exp-yellow-300 transition-colors px-6 py-3 text-black rounded-e-md cursor-pointer hover:bg-exp-red-300 hover:text-white"
  >
    {{ _x('Search', 'submit button', 'sage') }}
  </button>

</form>