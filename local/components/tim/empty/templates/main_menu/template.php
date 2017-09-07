<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */

$sections = \Local\Catalog\Section::getAll();

if ($arParams['TYPE'] == 'offcanvas')
{
	?>
	<nav class="offcanvas-navbar">
		<ul class="offcanvas-nav">
			<li><a href="/">Главная</a></li>
			<li class="menu-item-has-children dropdown">
				<a href="<?= CATALOG_PATH ?>" class="dropdown-hover">Каталог <span class="caret"></span></a>
				<ul class="dropdown-menu"><?

					$category = \Local\Catalog\Section::getByCode('wood');
					?>
					<li class="menu-item-has-children dropdown-submenu">
						<a href="<?= CATALOG_PATH ?>wood/"><?= $category['NAME'] ?> <span class="caret"></span></a>
						<ul class="dropdown-menu"><?

							foreach ($category['ITEMS'] as $id)
							{
								$item = \Local\Catalog\Section::getById($id);
								?>
								<li><a href="<?= CATALOG_PATH ?><?= $item['CODE'] ?>/"><?= $item['NAME'] ?></a></li><?
							}

							?>
						</ul>
					</li><?

					$category = \Local\Catalog\Section::getByCode('floor');
					?>
					<li class="menu-item-has-children dropdown-submenu">
						<a href="javascript:void(0)">Другие покрытия <span class="caret"></span></a>
						<ul class="dropdown-menu"><?

							foreach ($category['ITEMS'] as $id)
							{
								$item = \Local\Catalog\Section::getById($id);
								if ($item['CODE'] == 'wood')
									continue;

								?>
								<li><a href="<?= CATALOG_PATH ?><?= $item['CODE'] ?>/"><?= $item['NAME'] ?></a></li><?
							}

							?>
						</ul>
					</li>
					<li class="menu-item-has-children dropdown-submenu">
						<a href="javascript:void(0)">Производители <span class="caret"></span></a>
						<ul class="dropdown-menu"><?

							$items = \Local\Catalog\Brand::getForMenu();
							foreach ($items as $item)
							{
								?>
								<li><a href="<?= CATALOG_PATH ?><?= $item['CODE'] ?>/"><?= $item['NAME'] ?></a></li><?
							}

							?>
						</ul>
					</li>
					<li class="menu-item-has-children dropdown-submenu">
						<a href="javascript:void(0)">Породы дерева <span class="caret"></span></a>
						<ul class="dropdown-menu"><?

							$items = \Local\Catalog\Wood::getForMenu();
							foreach ($items as $item)
							{
								?>
								<li><a href="<?= CATALOG_PATH ?>floor/<?= $item['CODE'] ?>/"><?= $item['NAME']
									?></a></li><?
							}

							?>
						</ul>
					</li>
				</ul>
			</li>
			<li class="menu-item-has-children dropdown">
				<a href="<?= CATALOG_PATH ?>add/" class="dropdown-hover">Сопутствующие товары <span class="caret"></span></a>
				<ul class="dropdown-menu"><?

					$category = \Local\Catalog\Section::getByCode('add');
					foreach ($category['ITEMS'] as $id)
					{
						$item = \Local\Catalog\Section::getById($id);

						?>
						<li><a href="<?= CATALOG_PATH ?><?= $item['CODE'] ?>/"><?= $item['NAME'] ?></a></li><?
					}

					?>
				</ul>
			</li>
			<li class="menu-item-has-children dropdown">
				<a href="/about/" class="dropdown-hover">О компании <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="/about/contacts/">Контакты</a></li>
					<li><a href="/about/delivery/">Доставка</a></li>
					<li><a href="/about/guaranty/">Гарантия</a></li>
					<li><a href="/about/howto/">Как купить</a></li>
				</ul>
			</li>
		</ul>
	</nav><?
}
elseif ($arParams['TYPE'] == 'primary')
{
	?>
	<nav class="collapse navbar-collapse primary-navbar-collapse">
		<ul class="nav navbar-nav primary-nav">

    <?if(isset($_GET['test'])):?>
            <!--  Старые стили оставил для возврата   -->
			<li><a href="/"><span class="underline">Главная</span></a></li>
			<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown">
				<a href="<?= CATALOG_PATH ?>" class="dropdown-hover">
					<span class="underline">Каталог</span> <span class="caret"></span>
				</a>
				<ul class="dropdown-menu"><?

					$category = \Local\Catalog\Section::getByCode('wood');
					?>
					<li class="mega-col-3">
						<h3 class="megamenu-title"><?= $category['NAME'] ?> <span class="caret"></span></h3>
						<ul class="dropdown-menu"><?

							foreach ($category['ITEMS'] as $id)
							{
								$item = \Local\Catalog\Section::getById($id);
								?>
								<li><a href="<?= CATALOG_PATH ?><?= $item['CODE'] ?>/"><?= $item['NAME'] ?></a></li><?
							}

							?>
						</ul>
					</li><?

					$category = \Local\Catalog\Section::getByCode('floor');
					?>
					<li class="mega-col-3">
						<h3 class="megamenu-title">Другие покрытия <span class="caret"></span></h3>
						<ul class="dropdown-menu"><?

							foreach ($category['ITEMS'] as $id)
							{
								$item = \Local\Catalog\Section::getById($id);
								if ($item['CODE'] == 'wood')
									continue;

								?>
								<li><a href="<?= CATALOG_PATH ?><?= $item['CODE'] ?>/"><?= $item['NAME'] ?></a></li><?
							}

							?>
						</ul>
					</li>
					<li class="mega-col-3">
						<h3 class="megamenu-title">Производители <span class="caret"></span></h3>
						<ul class="dropdown-menu"><?

							$items = \Local\Catalog\Brand::getForMenu();
							foreach ($items as $item)
							{
								?>
								<li><a href="<?= CATALOG_PATH ?><?= $item['CODE'] ?>/"><?= $item['NAME']
									?></a></li><?
							}

							?>
						</ul>
					</li>
					<li class="mega-col-3">
						<h3 class="megamenu-title">Породы дерева <span class="caret"></span></h3>
						<ul class="dropdown-menu"><?

							$items = \Local\Catalog\Wood::getForMenu();
							foreach ($items as $item)
							{
								?>
								<li><a href="<?= CATALOG_PATH ?>floor/<?= $item['CODE'] ?>/"><?= $item['NAME']
									?></a></li><?
							}

							?>
						</ul>
					</li>
				</ul>
			</li>
			<li class="menu-item-has-children dropdown">
				<a href="<?= CATALOG_PATH ?>add/" class="dropdown-hover">
					<span class="underline">Сопутствующие товары</span> <span class="caret"></span>
				</a>
				<ul class="dropdown-menu"><?

					$category = \Local\Catalog\Section::getByCode('add');
					foreach ($category['ITEMS'] as $id)
					{
						$item = \Local\Catalog\Section::getById($id);

						?>
						<li><a href="<?= CATALOG_PATH ?><?= $item['CODE'] ?>/"><?= $item['NAME'] ?></a></li><?
					}

					?>
				</ul>
			</li>
			<li class="menu-item-has-children dropdown">
				<a href="/about/" class="dropdown-hover">
					<span class="underline">О компании</span> <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="/about/contacts/">Контакты</a></li>
					<li><a href="/about/delivery/">Доставка</a></li>
					<li><a href="/about/guaranty/">Гарантия</a></li>
					<li><a href="/about/howto/">Как купить</a></li>
				</ul>
			</li>
        <?else:?>
            <?/*?><li class="menu-item-has-children ">
                <a href="/about/">
                    <span class="underline">Акции</span> <span class="caret"></span>
                </a>
            </li>
            <li class="menu-item-has-children ">
                <a href="/about/">
                    <span class="underline">Новинки</span> <span class="caret"></span>
                </a>
            </li><?*/?>
            <li class="menu-item-has-children ">
                <a href="/cat/laminate/">
                    <span class="underline">Ламинат</span> <span class="caret"></span>
                </a>
            </li>
            <li class="menu-item-has-children ">
                <a href="/cat/parquet/">
                    <span class="underline">Паркетная доска</span> <span class="caret"></span>
                </a>
            </li>
            <li class="menu-item-has-children ">
                <a href="/cat/massive/">
                    <span class="underline">Массивная доска</span> <span class="caret"></span>
                </a>
            </li>
            <li class="menu-item-has-children ">
                <a href="/cat/engineer/">
                    <span class="underline">Инженерная доска</span> <span class="caret"></span>
                </a>
            </li>
            <li class="menu-item-has-children ">
                <a href="/cat/cork/">
                    <span class="underline">Пробковые полы</span> <span class="caret"></span>
                </a>
            </li>
            <li class="menu-item-has-children megamenu megamenu-fullwidth dropdown">
                <a href="/" class="dropdown-hover">
                    <span class="underline">Еще</span> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="mega-col-4">
                        <h3 class="megamenu-title">Деревянные полы<span class="caret"></span></h3>
                        <ul class="dropdown-menu">
                            <li><a href="/cat/piece/">Штучный паркет</a></li>
                            <li><a href="/cat/modular/">Модульный паркет</a></li>
                            <li><a href="/cat/terrace/">Террасная доска</a></li>
                        </ul>
                    </li>
                    <li class="mega-col-4">
                        <h3 class="megamenu-title">Другие покрытия<span class="caret"></span></h3>
                        <ul class="dropdown-menu">
                            <li><a href="/cat/cork/">Пробковые полы</a></li>
                            <li><a href="/cat/vinyl/">Виниловые полы</a></li>
                            <li><a href="/cat/leather/">Кожаные полы</a></li>
                            <li><a href="/cat/marmoleum/">Мармолеум</a></li>
                        </ul>
                    </li>
                    <li class="mega-col-4">
                        <h3 class="megamenu-title">Сопутствующие товары<span class="caret"></span></h3>
                        <ul class="dropdown-menu">
                            <li><a href="/cat/plinth/">Плинтусы, порожки</a></li>
                            <li><a href="/cat/glue/">Клей</a></li>
                            <li><a href="/cat/oil/">Масла, лаки</a></li>
                            <li><a href="/cat/other/">Разное</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
		</ul>
        <?endif;?>
	</nav><?
}
?>