<div>
    <img src="data:image/png;base64,{{ $getRecord()->qrcode }}" alt="QR Code" class="w-12 h-12" width="100px" />

    <p class="mb-2"></p>
    <a href="{{ route('download.qrcode', ['id' => $getRecord()->id]) }}" class="btn btn-primary mt-6">
        Télécharger le QR Code
    </a>
</div>
