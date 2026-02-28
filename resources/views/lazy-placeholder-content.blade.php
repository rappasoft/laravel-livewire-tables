@if ($isTailwind)
    <div class="w-full" role="status" aria-label="Loading table data...">
        <div class="mb-4 flex items-center justify-between">
            <div class="h-8 w-48 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
            <div class="h-8 w-32 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-200 shadow dark:border-gray-700 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-none">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        @for ($col = 0; $col < 4; $col++)
                            <th class="px-6 py-3">
                                <div class="h-4 w-3/4 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                            </th>
                        @endfor
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white dark:divide-none dark:bg-gray-800">
                    @for ($i = 0; $i < 10; $i++)
                        <tr>
                            @for ($col = 0; $col < 4; $col++)
                                <td class="px-6 py-4">
                                    <div class="h-4 animate-pulse rounded bg-gray-200 dark:bg-gray-700" style="width: {{ [60, 75, 50, 40][$col % 4] }}%"></div>
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex items-center justify-between px-4 sm:px-0">
            <div class="h-4 w-48 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
            <div class="flex gap-1">
                <div class="h-8 w-8 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                <div class="h-8 w-8 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                <div class="h-8 w-8 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
            </div>
        </div>
    </div>
@elseif ($isBootstrap)
    <div class="w-100" role="status" aria-label="Loading table data...">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="placeholder-glow">
                <span class="placeholder col-4" style="height: 32px; display: inline-block; border-radius: 4px;"></span>
            </div>
            <div class="placeholder-glow">
                <span class="placeholder col-3" style="height: 32px; display: inline-block; border-radius: 4px;"></span>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        @for ($col = 0; $col < 4; $col++)
                            <th class="placeholder-glow">
                                <span class="placeholder col-8" style="border-radius: 4px;"></span>
                            </th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 10; $i++)
                        <tr>
                            @for ($col = 0; $col < 4; $col++)
                                <td class="placeholder-glow">
                                    <span class="placeholder" style="width: {{ [60, 75, 50, 40][$col % 4] }}%; border-radius: 4px;"></span>
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="placeholder-glow">
                <span class="placeholder col-6" style="border-radius: 4px;"></span>
            </div>
            <div class="d-flex gap-1">
                <div class="placeholder-glow">
                    <span class="placeholder" style="width: 32px; height: 32px; display: inline-block; border-radius: 4px;"></span>
                </div>
                <div class="placeholder-glow">
                    <span class="placeholder" style="width: 32px; height: 32px; display: inline-block; border-radius: 4px;"></span>
                </div>
                <div class="placeholder-glow">
                    <span class="placeholder" style="width: 32px; height: 32px; display: inline-block; border-radius: 4px;"></span>
                </div>
            </div>
        </div>
    </div>
@endif
