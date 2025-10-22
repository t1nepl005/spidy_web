<x-layout title="David's Todo List">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from { 
                opacity: 0;
                transform: translateY(-10px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-backdrop {
            animation: fadeIn 0.2s ease-in-out;
        }

        .modal-content {
            animation: slideUp 0.3s ease-in-out;
        }

        .tab-content {
            animation: fadeIn 0.2s ease-in-out;
        }

        .dropdown-menu {
            animation: slideDown 0.2s ease-in-out;
        }
    </style>

    <div class="font-body antialiased bg-spider-soft text-spider-accent">
        <div x-data="taskApp()" x-init="init()" class="min-h-screen">
            <!-- Top Navigation -->
            <header class="fixed top-0 left-0 right-0 z-40 bg-spider-secondary shadow-soft border-b border-gray-200">
                <nav class="px-4 py-4 md:px-8">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-2xl font-heading font-bold text-spider-dark">David Todo List</h1>
                        <button 
                            @click="showMobileMenu = !showMobileMenu"
                            class="p-2 text-spider-dark hover:text-spider-primary transition-colors focus:outline-none focus:ring-2 focus:ring-spider-primary rounded md:hidden"
                            aria-label="Menu"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Tabs and Actions -->
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <!-- Tabs -->
                        <div class="flex space-x-1 overflow-x-auto">
                            @foreach(['all' => 'All', 'pending' => 'Pending', 'doing' => 'Doing', 'finished' => 'Finished'] as $id => $label)
                                <a
                                    href="{{ route('david-todo-list.index', ['tab' => $id]) }}"
                                    class="{{ request('tab', 'all') === $id ? 'border-b-2 border-spider-primary text-spider-primary font-semibold' : 'text-spider-dark hover:text-spider-primary' }} px-4 py-2 text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-spider-primary rounded-t bg-transparent whitespace-nowrap"
                                >
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>

                        <!-- Action Buttons (Desktop: always visible, Mobile: collapsible) -->
                        <div x-show="showMobileMenu || window.innerWidth >= 768" class="flex items-center gap-2 mt-4 md:mt-0">
                            <!-- Filter Button (Visible only on 'all' tab) -->
                            <div class="relative" x-show="activeTab === 'all'">
                                <button
                                    @click="showFilterMenu = !showFilterMenu"
                                    :class="hasActiveFilters ? 'text-spider-primary' : 'text-spider-dark'"
                                    class="p-2 hover:bg-gray-100 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-spider-primary"
                                    aria-label="Filter tasks"
                                    title="Filter"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                    </svg>
                                </button>

                                <!-- Filter Dropdown -->
                                <div 
                                    x-show="showFilterMenu"
                                    @click.away="showFilterMenu = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                    class="absolute right-0 mt-2 w-56 bg-spider-secondary rounded-lg shadow-soft border border-gray-200 py-2 dropdown-menu z-50"
                                    style="display: none;"
                                >
                                    <div class="px-4 py-2 text-xs font-semibold text-spider-muted uppercase">Filter by Status</div>
                                    <label class="flex items-center px-4 py-2 hover:bg-gray-50 cursor-pointer">
                                        <input type="checkbox" x-model="filters.pending" class="w-4 h-4 text-spider-primary focus:ring-2 focus:ring-spider-primary rounded">
                                        <span class="ml-3 text-sm text-spider-accent">Pending</span>
                                    </label>
                                    <label class="flex items-center px-4 py-2 hover:bg-gray-50 cursor-pointer">
                                        <input type="checkbox" x-model="filters.doing" class="w-4 h-4 text-spider-primary focus:ring-2 focus:ring-spider-primary rounded">
                                        <span class="ml-3 text-sm text-spider-accent">Doing</span>
                                    </label>
                                    <label class="flex items-center px-4 py-2 hover:bg-gray-50 cursor-pointer">
                                        <input type="checkbox" x-model="filters.finished" class="w-4 h-4 text-spider-primary focus:ring-2 focus:ring-spider-primary rounded">
                                        <span class="ml-3 text-sm text-spider-accent">Finished</span>
                                    </label>
                                    <div class="border-t border-gray-200 my-2"></div>
                                    <button
                                        @click="applyFilters()"
                                        class="w-full text-left px-4 py-2 text-sm text-spider-primary hover:bg-gray-50"
                                    >
                                        Apply Filters
                                    </button>
                                    <button
                                        @click="clearFilters()"
                                        class="w-full text-left px-4 py-2 text-sm text-spider-primary hover:bg-gray-50"
                                    >
                                        Clear Filters
                                    </button>
                                </div>
                            </div>

                            <!-- Sort Button -->
                            <div class="relative">
                                <button
                                    @click="showSortMenu = !showSortMenu"
                                    class="p-2 text-spider-dark hover:bg-gray-100 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-spider-primary"
                                    aria-label="Sort tasks"
                                    title="Sort"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                                    </svg>
                                </button>

                                <!-- Sort Dropdown -->
                                <div 
                                    x-show="showSortMenu"
                                    @click.away="showSortMenu = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                    class="absolute right-0 mt-2 w-48 bg-spider-secondary rounded-lg shadow-soft border border-gray-200 py-2 dropdown-menu z-50"
                                    style="display: none;"
                                >
                                    <div class="px-4 py-2 text-xs font-semibold text-spider-muted uppercase">Sort by</div>
                                    <button
                                        @click="setSortBy('created_at')"
                                        :class="sortBy === 'created_at' ? 'bg-gray-100 text-spider-primary font-semibold' : 'text-spider-accent'"
                                        class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50"
                                    >
                                        Date Created
                                    </button>
                                    <button
                                        @click="setSortBy('status')"
                                        :class="sortBy === 'status' ? 'bg-gray-100 text-spider-primary font-semibold' : 'text-spider-accent'"
                                        class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50"
                                    >
                                        Status
                                    </button>
                                    <button
                                        @click="setSortBy('title')"
                                        :class="sortBy === 'title' ? 'bg-gray-100 text-spider-primary font-semibold' : 'text-spider-accent'"
                                        class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50"
                                    >
                                        Title
                                    </button>
                                </div>
                            </div>

                            <!-- Sort Order Toggle -->
                            <button
                                @click="toggleSortOrder()"
                                class="p-2 text-spider-dark hover:bg-gray-100 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-spider-primary"
                                :aria-label="sortOrder === 'asc' ? 'Ascending order' : 'Descending order'"
                                :title="sortOrder === 'asc' ? 'Ascending' : 'Descending'"
                            >
                                <svg x-show="sortOrder === 'asc'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                                </svg>
                                <svg x-show="sortOrder === 'desc'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                                </svg>
                            </button>

                            <!-- View Mode Toggle -->
                            <button
                                @click="toggleViewMode()"
                                class="p-2 text-spider-dark hover:bg-gray-100 rounded transition-colors focus:outline-none focus:ring-2 focus:ring-spider-primary"
                                :aria-label="viewMode === 'card' ? 'Switch to table view' : 'Switch to card view'"
                                :title="viewMode === 'card' ? 'Table View' : 'Card View'"
                            >
                                <svg x-show="viewMode === 'card'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                                <svg x-show="viewMode === 'table'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Main Content -->
            <main class="pt-32 md:pt-28 px-4 pb-24 md:px-8 lg:px-16">
                <div class="max-w-7xl mx-auto">
                    <!-- Card View -->
                    <div x-show="viewMode === 'card'" class="tab-content grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @forelse ($tasks as $task)
                            <article 
                                @click="openTaskDetail({{ $task->id }})"
                                class="bg-spider-secondary rounded-xl p-6 border border-gray-200 cursor-pointer hover:border-spider-primary transition-all focus:outline-none focus:ring-2 focus:ring-spider-primary"
                                tabindex="0"
                                @keydown.enter="openTaskDetail({{ $task->id }})"
                            >
                                <h3 class="text-lg font-heading font-semibold text-spider-accent mb-2">{{ $task->title }}</h3>
                                <span 
                                    :class="{
                                        'bg-yellow-400 text-white': '{{ $task->status }}' === 'pending',
                                        'bg-blue-500 text-white': '{{ $task->status }}' === 'doing',
                                        'bg-green-500 text-white': '{{ $task->status }}' === 'finished'
                                    }"
                                    class="inline-block px-3 py-1 text-xs font-medium rounded-full"
                                >
                                    {{ ucfirst($task->status) }}
                                </span>
                            </article>
                        @empty
                            <div class="col-span-full text-center py-16">
                                <p class="text-spider-muted text-lg">No tasks found. Create your first task!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Table View -->
                    <div x-show="viewMode === 'table'" class="tab-content bg-spider-secondary rounded-xl border border-gray-200 overflow-hidden" style="display: none;">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-100 border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-spider-muted uppercase tracking-wider">
                                            <a href="{{ route('david-todo-list.index', array_merge(request()->query(), ['sort_by' => 'title', 'sort_order' => request('sort_order', 'desc') === 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center gap-1 hover:text-spider-primary">
                                                Task Name
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                                </svg>
                                            </a>
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-spider-muted uppercase tracking-wider">
                                            <a href="{{ route('david-todo-list.index', array_merge(request()->query(), ['sort_by' => 'status', 'sort_order' => request('sort_order', 'desc') === 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center gap-1 hover:text-spider-primary">
                                                Status
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                                </svg>
                                            </a>
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-spider-muted uppercase tracking-wider">Details</th>
                                        <th class="px-6 py-4 text-right text-xs font-semibold text-spider-muted uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($tasks as $task)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-medium text-spider-accent">{{ $task->title }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span 
                                                    :class="{
                                                        'bg-yellow-400 text-white': '{{ $task->status }}' === 'pending',
                                                        'bg-blue-500 text-white': '{{ $task->status }}' === 'doing',
                                                        'bg-green-500 text-white': '{{ $task->status }}' === 'finished'
                                                    }"
                                                    class="inline-block px-3 py-1 text-xs font-medium rounded-full"
                                                >
                                                    {{ ucfirst($task->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-spider-muted truncate max-w-xs">{{ $task->details ?? 'No details' }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <button
                                                        @click="openTaskDetail({{ $task->id }})"
                                                        class="px-4 py-2 text-sm font-medium text-white bg-spider-dark rounded-xl hover:bg-spider-primary transition-colors focus:outline-none focus:ring-2 focus:ring-spider-primary"
                                                    >
                                                        Edit
                                                    </button>
                                                    <button
                                                        @click="selectedTaskId = {{ $task->id }}; showDeleteModal = true"
                                                        class="px-4 py-2 text-sm font-medium text-spider-accent bg-gray-200 rounded-xl hover:bg-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400"
                                                    >
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-16 text-center text-spider-muted">
                                                No tasks found. Create your first task!
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $tasks->appends(request()->query())->links() }}
                    </div>
                </div>
            </main>

            <!-- Floating Action Button -->
            <button
                @click="openCreateModal()"
                class="fixed bottom-8 right-8 w-14 h-14 bg-spider-primary text-white rounded-full shadow-soft hover:bg-spider-dark transition-all focus:outline-none focus:ring-2 focus:ring-spider-primary focus:ring-offset-2 flex items-center justify-center z-30"
                aria-label="Create new task"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </button>

            <!-- Task Detail Modal -->
            <div 
                x-show="showDetailModal"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-800 bg-opacity-60 modal-backdrop"
                style="display: none;"
                @click.self="showDetailModal = false"
            >
                <div 
                    class="bg-spider-secondary rounded-2xl max-w-lg w-full p-8 modal-content"
                    role="dialog"
                    aria-labelledby="detail-modal-title"
                    aria-modal="true"
                >
                    <h2 id="detail-modal-title" class="text-2xl font-heading font-bold text-spider-accent mb-4" x-text="selectedTask?.title"></h2>
                    <p class="text-spider-muted mb-4 whitespace-pre-wrap" x-text="selectedTask?.details || 'No details provided.'"></p>
                    <div class="mb-6">
                        <span 
                            :class="{
                                'bg-yellow-400 text-white': selectedTask?.status === 'pending',
                                'bg-blue-500 text-white': selectedTask?.status === 'doing',
                                'bg-green-500 text-white': selectedTask?.status === 'finished'
                            }"
                            class="inline-block px-3 py-1 text-sm font-medium rounded-full"
                            x-text="selectedTask?.status ? selectedTask.status.charAt(0).toUpperCase() + selectedTask.status.slice(1) : ''"
                        ></span>
                    </div>
                    <div class="flex flex-wrap gap-3 mb-4">
                        <form action="{{ route('david-todo-list.update-status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" x-bind:value="selectedTask?.id">
                            <input type="hidden" name="status" value="pending">
                            <button
                                type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-yellow-400 rounded-xl hover:bg-yellow-500 transition-colors focus:outline-none focus:ring-2 focus:ring-yellow-400"
                                x-show="selectedTask?.status !== 'pending'"
                            >
                                Mark as Pending
                            </button>
                        </form>
                        <form action="{{ route('david-todo-list.update-status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" x-bind:value="selectedTask?.id">
                            <input type="hidden" name="status" value="doing">
                            <button
                                type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-xl hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"
                                x-show="selectedTask?.status !== 'doing'"
                            >
                                Mark as Doing
                            </button>
                        </form>
                        <form action="{{ route('david-todo-list.update-status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" x-bind:value="selectedTask?.id">
                            <input type="hidden" name="status" value="finished">
                            <button
                                type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-xl hover:bg-green-600 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500"
                                x-show="selectedTask?.status !== 'finished'"
                            >
                                Mark as Finished
                            </button>
                        </form>
                    </div>
                    <div class="flex gap-3">
                        <button
                            @click="openEditModal()"
                            class="flex-1 px-6 py-3 bg-spider-dark text-white font-medium rounded-xl hover:bg-spider-primary transition-colors focus:outline-none focus:ring-2 focus:ring-spider-primary"
                        >
                            Edit
                        </button>
                        <button
                            @click="showDetailModal = false; selectedTaskId = selectedTask.id; showDeleteModal = true"
                            class="flex-1 px-6 py-3 bg-gray-200 text-spider-accent font-medium rounded-xl hover:bg-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>

            <!-- Create/Edit Modal -->
            <div 
                x-show="showFormModal"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-800 bg-opacity-60 modal-backdrop"
                style="display: none;"
                @click.self="showFormModal = false"
            >
                <div 
                    class="bg-spider-secondary rounded-2xl max-w-lg w-full p-8 modal-content"
                    role="dialog"
                    :aria-labelledby="isEditing ? 'edit-modal-title' : 'create-modal-title'"
                    aria-modal="true"
                >
                    <h2 
                        :id="isEditing ? 'edit-modal-title' : 'create-modal-title'"
                        class="text-2xl font-heading font-bold text-spider-accent mb-6"
                        x-text="isEditing ? 'Edit Task' : 'Create New Task'"
                    ></h2>

                    <form :action="isEditing ? '{{ route('david-todo-list.update') }}' : '{{ route('david-todo-list.store') }}'" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-xl">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" name="id" x-bind:value="selectedTask?.id" x-show="isEditing">
                        <div class="mb-6">
                            <label for="task-title" class="block text-sm font-medium text-spider-accent mb-2">Task Title</label>
                            <input
                                id="task-title"
                                type="text"
                                name="title"
                                x-model="formData.title"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-spider-primary focus:border-transparent text-spider-accent bg-white"
                                placeholder="Enter task title"
                            >
                        </div>

                        <div class="mb-6">
                            <label for="task-adv-details" class="block text-sm font-medium text-spider-accent mb-2">Task Details</label>
                            <textarea
                                id="task-adv-details"
                                name="details"
                                x-model="formData.details"
                                rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-spider-primary focus:border-transparent text-spider-accent bg-white resize-none"
                                placeholder="Enter task details (optional)"
                            ></textarea>
                        </div>

                        <div class="mb-8">
                            <fieldset>
                                <legend class="block text-sm font-medium text-spider-accent mb-3">Status</legend>
                                <div class="space-y-3">
                                    @foreach(['pending', 'doing', 'finished'] as $status)
                                        <label class="flex items-center cursor-pointer">
                                            <input
                                                type="radio"
                                                name="status"
                                                value="{{ $status }}"
                                                x-model="formData.status"
                                                class="w-4 h-4 text-spider-primary focus:ring-2 focus:ring-spider-primary"
                                            >
                                            <span class="ml-3 text-spider-accent">{{ ucfirst($status) }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </fieldset>
                        </div>

                        <div class="flex gap-3">
                            <button
                                type="button"
                                @click="showFormModal = false"
                                class="flex-1 px-6 py-3 bg-gray-200 text-spider-accent font-medium rounded-xl hover:bg-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="flex-1 px-6 py-3 bg-spider-primary text-white font-medium rounded-xl hover:bg-spider-dark transition-colors focus:outline-none focus:ring-2 focus:ring-spider-primary"
                                x-text="isEditing ? 'Update' : 'Create'"
                            ></button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div 
                x-show="showDeleteModal"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-800 bg-opacity-60 modal-backdrop"
                style="display: none;"
                @click.self="showDeleteModal = false"
            >
                <div 
                    class="bg-spider-secondary rounded-2xl max-w-md w-full p-8 modal-content"
                    role="dialog"
                    aria-labelledby="delete-modal-title"
                    aria-modal="true"
                >
                    <h2 id="delete-modal-title" class="text-xl font-heading font-bold text-spider-accent mb-4">Delete Task</h2>
                    <p class="text-spider-muted mb-6">Are you sure you want to delete this task?</p>
                    <div class="flex gap-3">
                        <button
                            @click="showDeleteModal = false; showDetailModal = true"
                            class="flex-1 px-6 py-3 bg-gray-200 text-spider-accent font-medium rounded-xl hover:bg-gray-300 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400"
                        >
                            Cancel
                        </button>
                        <form action="{{ route('david-todo-list.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" x-bind:value="selectedTaskId">
                            <button
                                type="submit"
                                class="flex-1 px-6 py-3 bg-yellow-400 text-white font-medium rounded-xl hover:bg-yellow-500 transition-colors focus:outline-none focus:ring-2 focus:ring-yellow-400"
                            >
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script>
            function taskApp() {
                return {
                    activeTab: '{{ request('tab', 'all') }}',
                    showDetailModal: false,
                    showFormModal: false,
                    showDeleteModal: false,
                    showFilterMenu: false,
                    showSortMenu: false,
                    showMobileMenu: false,
                    selectedTask: null,
                    selectedTaskId: null,
                    isEditing: false,
                    viewMode: 'card',
                    sortBy: '{{ request('sort_by', 'created_at') }}',
                    sortOrder: '{{ request('sort_order', 'desc') }}',
                    @php
                    $filters = request('filters') ? (is_string(request('filters')) ? explode(',', request('filters')) : (is_array(request('filters')) ? request('filters') : [])) : [];
                    @endphp

                    filters: {
                        pending: @json(in_array('pending', $filters)),
                        doing: @json(in_array('doing', $filters)),
                        finished: @json(in_array('finished', $filters))
                    },
                    formData: {
                        title: '',
                        details: '',
                        status: 'pending'
                    },

                    init() {
                        this.updateTitle();
                        // Sync view mode with session storage
                        this.viewMode = sessionStorage.getItem('viewMode') || 'card';
                    },

                    get hasActiveFilters() {
                        return this.filters.pending || this.filters.doing || this.filters.finished;
                    },

                    applyFilters() {
                        const filters = [];
                        if (this.filters.pending) filters.push('pending');
                        if (this.filters.doing) filters.push('doing');
                        if (this.filters.finished) filters.push('finished');
                        const url = new URL(window.location);
                        if (filters.length > 0) {
                            url.searchParams.set('filters', filters.join(','));
                        } else {
                            url.searchParams.delete('filters');
                        }
                        window.location = url;
                    },

                    clearFilters() {
                        this.filters.pending = false;
                        this.filters.doing = false;
                        this.filters.finished = false;
                        const url = new URL(window.location);
                        url.searchParams.delete('filters');
                        window.location = url;
                    },

                    setSortBy(sortBy) {
                        this.sortBy = sortBy;
                        const url = new URL(window.location);
                        url.searchParams.set('sort_by', sortBy);
                        window.location = url;
                    },

                    toggleSortOrder() {
                        this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
                        const url = new URL(window.location);
                        url.searchParams.set('sort_order', this.sortOrder);
                        window.location = url;
                    },

                    toggleViewMode() {
                        this.viewMode = this.viewMode === 'card' ? 'table' : 'card';
                        sessionStorage.setItem('viewMode', this.viewMode);
                    },

                    async openTaskDetail(taskId) {
                        try {
                            const response = await fetch(`{{ route('david-todo-list.show') }}?id=${taskId}`);
                            this.selectedTask = await response.json();
                            this.selectedTaskId = taskId;
                            this.showDetailModal = true;
                        } catch (error) {
                            console.error('Error fetching task:', error);
                        }
                    },

                    openCreateModal() {
                        this.isEditing = false;
                        this.formData = {
                            title: '',
                            details: '',
                            status: 'pending'
                        };
                        this.showFormModal = true;
                    },

                    openEditModal() {
                        this.isEditing = true;
                        this.formData = {
                            title: this.selectedTask.title,
                            details: this.selectedTask.details,
                            status: this.selectedTask.status
                        };
                        this.showDetailModal = false;
                        this.showFormModal = true;
                    },

                    updateTitle() {
                        const tabLabel = {
                            'all': 'All',
                            'pending': 'Pending',
                            'doing': 'Doing',
                            'finished': 'Finished'
                        }[this.activeTab] || 'All';
                        document.title = `David Todo List - ${tabLabel} Tasks`;
                    }
                };
            }
        </script>
    </div>
</x-layout>