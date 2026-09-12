<div>
    <label id="listbox-label" class="block text-sm font-medium leading-6 text-gray-900">{{__('Select a category of interest','explora')}}:</label>
    <div class="relative mt-2">
      <button type="button" class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
        @if ($active)
            <span class="flex items-center">
                <span class="block truncate">{{$active->name}}</span>
            </span>
        @else
        <span class="flex items-center">
            <span class="block truncate">{{__('All','explora')}}</span>
        </span>
        @endif
        <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
          <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
          </svg>
        </span>
      </button>
      <ul class="hidden transition-opacity ease-in duration-100 absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" tabindex="-1" aria-expanded="true" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
        <li class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-0" role="option">
            <div class="flex items-center">
              <span class="{{!$active ? ' font-semibold':'font-normal'}} block truncate" data-value="all">{{__('All','explora')}}</span>
            </div>
            <span class="{{!$active ? 'text-indigo-600':'text-white'}} absolute inset-y-0 right-0 flex items-center pr-4 checkmark">
              <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
              </svg>
            </span>
          </li>
        @foreach($categories as $term)
        <li class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-0" role="option">
          <div class="flex items-center">
            <span class="{{$active && $active->slug == $term->slug  ? ' font-semibold':'font-normal'}} font-normal block truncate" data-value="{{ $term->slug }}">{{ $term->name }}</span>
          </div>
          <span class="{{$active && $active->slug == $term->slug  ? ' text-indigo-600':'text-white'}} absolute inset-y-0 right-0 flex items-center pr-4 checkmark">
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
            </svg>
          </span>
        </li>
        @endforeach
      </ul>
    </div>
    <form method="GET" action="{{ get_the_permalink() }}">
        <input type="hidden" name="category">
        <button type="submit" class="btn-primary mt-3 uppercase">{{__('Filter','explora')}}</button>
    </form>
  </div>