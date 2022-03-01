<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kaostory</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/css/style.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a href='/' class="navbar-brand">
                <img src="http://kaostory.id/wp-content/uploads/2020/12/logoks1.png" width="150px" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <form action="/" class="d-flex">
                    @csrf
                    <input class="form-control me-2" name="search" type="search" placeholder="Cari Desain"
                        aria-label="Search">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>
        </div>
    </nav>

    <section>
        <div class="container d-flex justify-content-between align-items-center mt-3">
            <div>
                @if (request()->get('category') && count($desain) == 0)
                    <h4></h4>
                @elseif (request()->get('category') && count($desain) > 0)
                    <h4>Semua Desain {{ request()->get('category') }}</h4>
                @elseif (request()->get('search') && count($desain) == 0)
                    <h4></h4>
                @elseif (request()->get('search') && count($desain) > 0)
                    <h4>Hasil Pencarian "{{ request()->get('search') }}"</h4>
                @else
                    <h4>Semua Desain</h4>
                @endif
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Pilih Kategori
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach ($categories as $category)
                        <li><a class="dropdown-item"
                                href="/?category={{ $category->name }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="mt-3">
        <div class="container">
            <div class="row">
                @if (count($desain) == 0)
                    <div class="col-md-12">
                        <div class="text-center text-secondary">
                            @if (request()->get('category'))
                                <h2>Tidak ada desain dalam kategori {{ request()->get('category') }}</h2>
                            @elseif(request()->get('search'))
                                <h2>Tidak ada desain dengan kata kunci "{{ request()->get('search') }}"</h2>
                            @endif
                        </div>
                    </div>
                @endif
                @foreach ($desain as $item)
                    <div class="col-lg-3 col-6">
                        <div class="card mb-3">
                            <img src="{{ asset('storage/logo/' . $item->thumbnail) }}" class="card-img-top img-fluid"
                                alt="...">
                            @foreach ($categories as $category)
                                @if ($category->id == $item->category)
                                    <div class="desain-badge text-white py-1 px-3"
                                        style="background-color: crimson; position: absolute; font-size:small;">
                                        {{ $category->name }}
                                    </div>
                                @endif
                            @endforeach
                            <div class="px-3 pt-3 pb-1">
                                <div class="d-flex justify-content-between ">
                                    <div>
                                        <h6 class="card-title">{{ $item->name }}</h6>
                                        <p style="font-size:small;" class="d-flex align-items-center"><span
                                                class="material-icons" style="font-size: small">
                                                file_download
                                            </span>Downloaded {{ rand(99, 399) }} x</p>
                                    </div>
                                    <div class="web">
                                        @if (Cookie::get('phone'))
                                            <a href="/download?file={{ $item->link }}"
                                                class="btn btn-sm btn-outline-secondary"> <span class="material-icons">
                                                    file_download
                                                </span></a>
                                        @else
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <span class="material-icons mx-2">
                                                    file_download
                                                </span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="mobile">
                                    @if (Cookie::get('phone'))
                                        <a href="/download?file={{ $item->link }}"
                                            class="btn btn-sm btn-outline-secondary mb-3" style="width: 100%"><span
                                                class="material-icons" style="font-size: small">
                                                file_download
                                            </span> Download</a>
                                    @else
                                        <button type="button" class="btn btn-sm btn-outline-secondary mb-3"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal" style="width: 100%">
                                            <span class="material-icons mx-2">
                                                file_download
                                            </span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="https://niceillustrations.com/wp-content/uploads/2020/10/hand-holding-phone.png"
                        width="300px" alt="">
                    <div class="p-3">
                        <form action="/validate" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label"></label>
                                <input type="text" class="form-control" name="phone" id="" aria-describedby="helpId"
                                    placeholder="Silahkan masukan nomor HP anda untuk melanjutkan download">
                            </div>
                            <button type="submit" class="btn btn-primary">Download Sekarang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
