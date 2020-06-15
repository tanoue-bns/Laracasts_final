{{-- ログイン後のtweet一覧表示などauth以外の共通部分 --}}
{{-- memo: x-ファイル名の $slot に読み込まれる --}}
<x-master>
    <section class="px-8">
        <main class="container mx-auto">
            <div class="lg:flex lg:justify-between">
                @auth
                    <div class="lg:w-32">
                        @include('_sidebar-links')
                    </div>
                @endauth


                <div class="flex-1 lg:mx-10" style="max-width: 700px;">
                    {{ $slot }}
                </div>

                @auth
                    <div class="lg:w-1/6 bg-blue-100 rounded-lg p-4">
                        @include('_friends-list')
                    </div>
                @endauth
            </div>
        </main>
    </section>
</x-master>
