<x-app>
    @include('partials._officialnav')
    <main class="sm:container sm:mx-auto sm:mt-10 sm:pt-20 pt-24 min-h-full mb-12">
        <div class="max-w-xl sm:mx-auto sm:px-6 mx-5">
    
            @if (session('status'))
                    <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                    @elseif (session('error'))
                    <div class="text-sm border border-t-8 rounded text-red-700 border-red-600 bg-red-100 px-3 py-4 mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
    
            <section class="flex flex-col break-words bg-[url('/images/lightpaperfibers.png')] sm:border-1 sm:rounded-md sm:shadow-lg">
    
                <header class="font-semibold bg-blue-300 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Create Official
                    
                </header>
                @include('partials._addofficialsearch')
                @unless(count($residents)==0)
                <form class="px-5 mb-10" action="/officials/createidhelper" method="POST">
                    @csrf
                    @foreach ($residents as $resident)
                <div class="grid grid-cols-6 gap-1">
                    <div class="col">
                        <input type="number" name="id" id="id"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter Resident Id" value= "{{$resident->id}}" >
                    </div>
                    <div class="col-span-4">
                        <input type="text" name="fullname" id="fullname"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter Resident Id" value= "{{$resident->last_name}}, {{$resident->first_name}} {{$resident->middle_name}} {{$resident->suffix}}">
                    </div>
                    <div class="col flex items-center justify-center bg-blue-500 rounded-md text-gray-100">
                        <button type="submit" >
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </form>
          @else <p class="text-center text-gray-800 py-10 text-xl">No Barangay Officials found</p>
          @endunless
                <div class="px-5 sm:pb-5 rounded-b-lg pt-10 bg-blue-100 rounded-b-md">
                    <form action="/officials/store" method="POST">
                        @csrf
                        <div>
                            <div class="mb-5">
                                <label for="resident_id" class="block mb-2 text-sm font-medium text-gray-900 ">Resident Id</label>
                                <input type="number" name="resident_id" id="resident_id"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter Resident Id" value="{{$data['id']}}" >
                                @error('resident_id')
                                    <p class="text-red-500 text-xs mt-2">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="barangayofficial_name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                                <input type="text" name="barangayofficial_name" id="barangayofficial_name"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter Name" value="{{$data['fullname']}}" >
                                @error('barangayofficial_name')
                                    <p class="text-red-500 text-xs mt-2">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 ">Role</label>
                                <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option value="" {{old('role') == "" ? 'selected' : ''}}></option>
                                    <option value="Chairman" {{old('role') == "Chairman" ? 'selected' : ''}}>Chairman</option>
                                    <option value="Kagawad" {{old('role') == "Kagawad" ? 'selected' : ''}}>Kagawad</option>
                                    <option value="SK Chairman" {{old('role') == "SK Chairman" ? 'selected' : ''}}>SK Chairman</option>
                                    <option value="Secretary" {{old('role') == "Secretary" ? 'selected' : ''}}>Secretary</option>
                                    <option value="Treasurer" {{old('role') == "Treasurer" ? 'selected' : ''}}>Treasurer</option>
                                </select>
                                  @error('role')
                                      <p class="text-red-500 text-xs mt-2">
                                          {{$message}}
                                      </p>
                                  @enderror
                              </div>
                            <div class="mb-5">
                                <label for="term_start" class="block mb-2 text-sm font-medium text-gray-900">Start Date</label>
                                <input type="date" name="term_start" id="term_start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter term_start" value={{old('term_start')}}>
                                @error('term_start')
                                    <p class="text-red-500 text-xs mt-2">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                            <div class="mb-10">
                                <label for="term_end" class="block mb-2 text-sm font-medium text-gray-900">End Date</label>
                                <input type="date" name="term_end" id="term_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Enter term_end" value={{old('term_end')}}>
                                @error('term_end')
                                    <p class="text-red-500 text-xs mt-2">
                                        {{$message}}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="mt-2 mx-5 sm:mx-0 sm:w-2/5 w-1/2 mb-6 text-white flex items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Create Official
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </main>
    @include('partials._officialsbackbutton')
    </x-app>