<? use Illuminate\Pagination\UrlWindow;

if ($items->hasPages()) :

    $window = UrlWindow::make($items);

		$elements = array_filter([
        $window['first'],
        is_array($window['slider']) ? '...' : null,
        $window['slider'],
        is_array($window['last']) ? '...' : null,
        $window['last'],
    ]);
		?>
    <nav>
        <ul class="pagination">
            <!-- Previous Page Link -->
            <? if ($items->onFirstPage()) : ?>
                <li class="page-item disabled" aria-disabled="true" aria-label="Пред">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            <? else : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $items->previousPageUrl() ?>" rel="prev" aria-label="Пред">&lsaquo;</a>
                </li>
            <? endif; ?>

            <!-- Pagination Elements -->
            <? foreach ($elements as $element) : ?>
                <!-- "Three Dots" Separator -->
                <? if (is_string($element)) : ?>
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link"><?= $element ?></span></li>
                <? endif; ?>

                <!-- Array Of Links -->
                <? if (is_array($element)) : ?>
                    <? foreach ($element as $page => $url) : ?>
                        <? if ($page == $items->currentPage()) : ?>
                            <li class="page-item active" aria-current="page"><span class="page-link"><?= $page ?></span></li>
                        <? else : ?>
                            <li class="page-item"><a class="page-link" href="<?= $url ?>"><?= $page ?></a></li>
                        <? endif; ?>
                    <? endforeach; ?>
                <? endif; ?>
            <? endforeach; ?>

            <!-- Next Page Link -->
            <? if ($items->hasMorePages()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $items->nextPageUrl() ?>" rel="next" aria-label="След">&rsaquo;</a>
                </li>
            <? else : ?>
                <li class="page-item disabled" aria-disabled="true" aria-label="След">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            <? endif; ?>
        </ul>
    </nav>
<? endif; ?>
