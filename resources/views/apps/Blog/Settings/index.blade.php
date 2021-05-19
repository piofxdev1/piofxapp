<x-dynamic-component :component="$app->componentName">

    <div class="card rounded">
        <div class="card-body">
            <div class="p-5 rounded-lg border bg-light d-flex justify-content-between align-items-center">
                <h1 class="m-0">Settings</h1>
                <a href="{{ route($app->module.'.edit') }}" class="btn btn-dark">Edit</a>
            </div>
            <pre class="bg-light p-7 mt-5 rounded-lg border"><code json class="bg-light text-dark h4">{{ $settings }}</code></pre>
        </div>
    </div>

</x-dynamic-component>