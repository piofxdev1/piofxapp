<x-dynamic-component :component="$app->componentName">

    <form action="{{ route($app->module.'.update') }}" method="POST">
        <div class="card rounded">
            <div class="card-body">
                <div class="p-5 rounded-lg border bg-light d-flex justify-content-between align-items-center">
                    <h1 class="m-0">Settings</h1>
                    <button type="submit" class="btn btn-dark">Update</button>

                </div>
                <div  class="mt-5">
                    <textarea name="settings" id="editor" cols="30" rows="10">{{ $settings }}</textarea>
                </div>
            </div>
        </div>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

</x-dynamic-component>