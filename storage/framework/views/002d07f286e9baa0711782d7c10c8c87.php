<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>
<body>
<div id="app">
    <?php if(Auth::check()): ?>
        <?php if (isset($component)) { $__componentOriginal5969be1373d4d98ca57cc1409b6a712a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5969be1373d4d98ca57cc1409b6a712a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.off-canvas-menu','data' => ['id' => 'offcanvasmenu','label' => 'Menu']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('off-canvas-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'offcanvasmenu','label' => 'Menu']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5969be1373d4d98ca57cc1409b6a712a)): ?>
<?php $attributes = $__attributesOriginal5969be1373d4d98ca57cc1409b6a712a; ?>
<?php unset($__attributesOriginal5969be1373d4d98ca57cc1409b6a712a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5969be1373d4d98ca57cc1409b6a712a)): ?>
<?php $component = $__componentOriginal5969be1373d4d98ca57cc1409b6a712a; ?>
<?php unset($__componentOriginal5969be1373d4d98ca57cc1409b6a712a); ?>
<?php endif; ?>
    <?php endif; ?>
    <nav class="navbar navbar-expand-md shadow-sm">

        <?php if(Auth::check()): ?>
            <button class="btn shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasmenu"
                    aria-controls="offcanvasmenu">
                <i class="bi bi-list"></i>
            </button>
        <?php endif; ?>

        <div class="container-fluid w-100">
            <div>
                <a class="navbar-brand" href="<?php echo e(url('/home')); ?>">
                    <?php echo e(config('app.name', 'Laravel')); ?>

                </a>
            </div>
            <div class=" ">

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    <?php if(auth()->guard()->guest()): ?>
                        <?php if(!Route::has('dashboard')): ?>
                            <?php if(Route::has('login')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <?php echo e(Auth::user()->name); ?>

                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Logout')); ?>

                                </a>

                                <a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">
                                    <?php echo e(__('Profile')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php if($message = Session::get('success')): ?>
        <div class="alert-custom alert alert-success m-4">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>
    <?php if($message = Session::get('error')): ?>
        <div class="alert-custom alert alert-danger m-4">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>

    <main class="py-4">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('components.generic-select-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('js.dinamic-select', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
<?php echo $__env->make('sweetalert::alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<script type="module">
    // attende 3 secondi (3000 ms) e poi nasconde l'alert con un effetto fade-out
    setTimeout(function () {
        let alert = document.querySelector('.alert-custom');
        if (alert) {
            alert.style.transition = "opacity 1s ease"; // durata dissolvenza
            alert.style.opacity = 0;
            setTimeout(() => {
                alert.style.display = "none"; // rimuove l'alert dopo il fade
            }, 500); // tempo uguale alla durata della transition
        }
    }, 5000);
</script>
<script>
    function carFilter(search, options) {
        if (!search) return options;
        return options.filter(o =>
            o.full_name.toLowerCase().includes(search.toLowerCase()) ||
            (o.car_plates && o.car_plates.filter(p => p.name.toLowerCase().includes(search.toLowerCase())).length > 0)
        );
    }
</script>
</body>
</html>
<?php /**PATH /mnt/Disk1/html/POLIZIA/mtrps/resources/views/layouts/app.blade.php ENDPATH**/ ?>