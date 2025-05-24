@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Detail Pekerjaan</h6>
                        <a href="{{ route('dashboard') }}" class="btn bg-gradient-dark btn-sm mb-0">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h6>Informasi Pekerjaan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <div class="mb-3">
                                            <span class="text-xs text-secondary">Kode Pekerjaan:</span>
                                            <p class="text-sm mb-0">{{ $pekerjaan->kode_pekerjaan }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <span class="text-xs text-secondary">Nama Pekerjaan:</span>
                                            <p class="text-sm mb-0">{{ $pekerjaan->nama }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <span class="text-xs text-secondary">Nomor Kontrak:</span>
                                            <p class="text-sm mb-0">{{ $pekerjaan->no_kontrak }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <span class="text-xs text-secondary">Anggaran:</span>
                                            <p class="text-sm mb-0">Rp. {{ number_format($pekerjaan->total, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <span class="text-xs text-secondary">Tanggal Tagihan:</span>
                                            <p class="text-sm mb-0">{{ \Carbon\Carbon::parse($pekerjaan->tanggal_tagihan)->format('d-m-Y') }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <span class="text-xs text-secondary">Kategori:</span>
                                            <p class="text-sm mb-0">{{ $pekerjaan->kategori }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <span class="text-xs text-secondary">Status:</span>
                                            <span class="badge badge-sm bg-gradient-{{
                                                $pekerjaan->status == 'Tagihan' ? 'success' :
                                                ($pekerjaan->status == 'BA' ? 'info' :
                                                ($pekerjaan->status == 'Barang' ? 'warning' :
                                                ($pekerjaan->status == 'Mulai' ? 'danger' :
                                                ($pekerjaan->status == 'IH' ? 'secondary' : 'primary'))))
                                            }}">
                                                {{ ucfirst($pekerjaan->status) }}
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            <span class="text-xs text-secondary">Deadline:</span>
                                            <p class="text-sm mb-0">{{ \Carbon\Carbon::parse($pekerjaan->deadline)->format('d-m-Y') }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <span class="text-xs text- secondary">Deskripsi:</span>
                                            <p class="text-sm mb-0">{{  $pekerjaan->deskripsi }}</p>
                                        </div>
                                     </div>
                                </div>
                             </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h6>Informasi Client</h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column">
                                        <div class="mb-3">
                                            <span class="text-xs text-secondary">Nama Client:</span>
                                            <p class="text-sm mb-0">{{ $pekerjaan->clients->nama ?? 'Belum Ditentukan' }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <span class="text-xs text-secondary">Kontak:</span>
                                            <p class="text-sm mb-0">{{ $pekerjaan->clients->kontak ?? 'Belum Ditentukan' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h6>Update Status</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('pekerjaan.updateStatus', $pekerjaan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="Mulai" {{ $pekerjaan->status == 'Mulai' ? 'selected' : '' }}>Mulai</option>
                                                        <option value="IH" {{ $pekerjaan->status == 'IH' ? 'selected' : '' }}>IH</option>
                                                        <option value="Barang" {{ $pekerjaan->status == 'Barang' ? 'selected' : '' }}>Barang</option>
                                                        <option value="BA" {{ $pekerjaan->status == 'BA' ? 'selected' : '' }}>BA</option>
                                                        <option value="Tagihan" {{ $pekerjaan->status == 'Tagihan' ? 'selected' : '' }}>Tagihan</option>
                                                        <option value="Selesai" {{ $pekerjaan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 d-flex align-items-end">
                                                <button type="submit" class="btn bg-gradient-dark w-100">Update Status</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
