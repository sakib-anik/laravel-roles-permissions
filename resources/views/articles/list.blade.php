<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Articles') }}
            </h2>
            @can('create articles')
            <a class="bg-slate-700 text-sm rounded-md text-white px-3 py-2" href="{{ route('articles.create') }}">Create</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left" width="60">#</th>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Author</th>
                        <th class="px-6 py-3 text-left" width="180">Created</th>
                        <th class="px-6 py-3 text-center" width="180">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if($articles->isNotEmpty())
                    @foreach($articles as $article)
                    <tr class="border-b">
                        <td class="px-6 py-3 text-left">
                            {{ $article->id }}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{ $article->title }}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{ $article->author }}
                        </td>
                        <td class="px-6 py-3 text-left">
                            {{ \Carbon\Carbon::parse($article->created_at)->format('d M, Y') }}
                        </td>
                        <td class="px-6 py-3 text-center">
                            @can('edit articles')
                            <a class="bg-slate-700 hover:bg-slate-600 text-sm rounded-md text-white px-3 py-2" href="{{ route('articles.edit',$article->id) }}">Edit</a>
                            @endcan
                            @can('delete articles')
                            <a onclick="deleteArticle({{$article->id}})" class="bg-red-600 hover:bg-red-500 text-sm rounded-md text-white px-3 py-2" href="javascript:void(0);">Delete</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div class="my-3">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
            const deleteArticle = (id) => {
                if(confirm("Are yo sure you want to delete?")){
                    $.ajax({
                        url: '{{ route("articles.destroy") }}',
                        type: 'delete',
                        data: {id:id},
                        dataType: 'json',
                        headers: {
                            'x-csrf-token': '{{ csrf_token() }}'
                        },
                        success: (response)=>{
                            window.location.href = '{{ route("articles.index") }}';
                        }
                    })
                }
            }
        </script>
    </x-slot>
</x-app-layout>
