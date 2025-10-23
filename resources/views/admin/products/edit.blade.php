@extends('admin.layout.app')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
    <div class="breadcrumbs">
        <a href="{{ route('admin.products.index') }}">Sản phẩm</a>
        <span>/</span>
        <span>Chỉnh sửa</span>
    </div>

    <div class="card-form">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-3" style="flex-direction:column;">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Tên sản phẩm</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <small style="color:#ff4fa5;">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-3" style="flex-wrap:wrap;">
                <div style="flex:1;min-width:220px;">
                    <label for="category_id">Danh mục</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}" @selected(old('category_id', $product->category_id) == $id)>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small style="color:#ff4fa5;">{{ $message }}</small>
                    @enderror
                </div>
                <div style="flex:1;min-width:220px;">
                    <label for="price">Giá bán (VNĐ)</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" min="0" step="1000" required>
                    @error('price')
                        <small style="color:#ff4fa5;">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description">Mô tả</label>
                <textarea id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <small style="color:#ff4fa5;">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="image">Ảnh sản phẩm</label>
                @if ($product->image)
                    <div style="margin-bottom:0.75rem;">
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" style="max-width:180px;border-radius:12px;">
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*">
                @error('image')
                    <small style="color:#ff4fa5;">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn-primary" style="border:none;border-radius:10px;padding:0.8rem 1.4rem;color:#fff;font-weight:600;cursor:pointer;">Cập nhật</button>
                <a href="{{ route('admin.products.index') }}" class="btn-outline">Quay lại</a>
            </div>
        </form>
    </div>
@endsection
