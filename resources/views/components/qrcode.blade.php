<div>
    {!! $getRecord()->qrcode !!}

    <p class="mb-2"></p>
    <a href="{{ route('download.qrcode', ['id' => $getRecord()->id]) }}" class="btn btn-primary mt-6">
        Télécharger le QR Code
    </a>
</div>
