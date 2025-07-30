<x-admin-nav>

<body class="font-sans bg-pam-gray-light">
    <!-- Navigation -->
    @if (session('error'))
                    <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded p-3 flex items-center justify-between">
                        <span>{{ session('error') }}</span>
                        <button type="button" class="ml-4 text-red-400 hover:text-red-600 focus:outline-none" onclick="this.parentElement.style.display='none'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded p-3 flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="ml-4 text-green-400 hover:text-green-600 focus:outline-none" onclick="this.parentElement.style.display='none'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-pam-blue">Roles Management</h1>
                <p class="text-pam-gray">Manage Roles accounts and contact information</p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <!-- Add User Button -->
                <button onclick="openAddUserModal()" class="bg-white border border-pam-gray-light text-pam-gray px-4 py-2 rounded-md hover:bg-pam-gray-light transition flex items-center">
                    <svg class="mr-2" width="24px" height="24px"  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#3a1cd4"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 18L17 18M17 18L14 18M17 18V15M17 18V21M11 21H4C4 17.134 7.13401 14 11 14C11.695 14 12.3663 14.1013 13 14.2899M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z" stroke="#2429bc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    Add
                </button>

                <!-- Add User Modal -->
                <div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white rounded-lg max-w-md w-full p-6 mx-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-pam-blue">Add User</h3>
                            <button onclick="closeAddUserModal()" class="text-pam-gray hover:text-pam-blue">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <form id="addUserForm" action={{ route('user.add') }} method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-pam-gray mb-1">Name</label>
                                <input type="text" name="name" required class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-pam-gray mb-1">Email</label>
                                <input type="email" name="email" required class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-pam-gray mb-1">Phone</label>
                                <input type="tel" name="phone" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-pam-gray mb-1">Company</label>
                                <input type="text" name="company_name" required class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-pam-gray mb-1">Address</label>
                                <input type="text" name="address" required class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-pam-gray mb-1">Password</label>
                                <input type="password" name="password" required class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-pam-gray mb-1">Role</label>
                                <select name="role" required class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                                    <option value="">Select a role</option>
            
                                    <option value="vendor">Vendor</option>
                                    <option value="operator">Operator</option>
                                    <option value="rider">Rider</option>
                                </select>
                            </div>
                            {{-- <div class="mb-4">
                                <label class="block text-sm font-medium text-pam-gray mb-1">Status</label>
                                <select name="is_active" required class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                                    <option value="pending">Pending</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div> --}}
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" onclick="closeAddUserModal()" class="bg-white py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-gray hover:bg-pam-gray-light">
                                    Cancel
                                </button>
                                <button type="submit" class="bg-pam-blue py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-pam-blue-light">
                                    Add User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
               
                <button class="bg-white border border-pam-gray-light text-pam-gray px-4 py-2 rounded-md hover:bg-pam-gray-light transition flex items-center">
                    <svg class="mr-2" width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 6H19M21 12H16M21 18H16M7 20V13.5612C7 13.3532 7 13.2492 6.97958 13.1497C6.96147 13.0615 6.93151 12.9761 6.89052 12.8958C6.84431 12.8054 6.77934 12.7242 6.64939 12.5617L3.35061 8.43826C3.22066 8.27583 3.15569 8.19461 3.10948 8.10417C3.06849 8.02393 3.03853 7.93852 3.02042 7.85026C3 7.75078 3 7.64677 3 7.43875V5.6C3 5.03995 3 4.75992 3.10899 4.54601C3.20487 4.35785 3.35785 4.20487 3.54601 4.10899C3.75992 4 4.03995 4 4.6 4H13.4C13.9601 4 14.2401 4 14.454 4.10899C14.6422 4.20487 14.7951 4.35785 14.891 4.54601C15 4.75992 15 5.03995 15 5.6V7.43875C15 7.64677 15 7.75078 14.9796 7.85026C14.9615 7.93852 14.9315 8.02393 14.8905 8.10417C14.8443 8.19461 14.7793 8.27583 14.6494 8.43826L11.3506 12.5617C11.2207 12.7242 11.1557 12.8054 11.1095 12.8958C11.0685 12.9761 11.0385 13.0615 11.0204 13.1497C11 13.2492 11 13.3532 11 13.5612V17L7 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    Filter
                </button>
                <button class="bg-pam-blue text-white px-4 py-2 rounded-md hover:bg-pam-blue-light transition flex items-center">
                    <svg class="mr-2 text-white" width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 20C7.58172 20 4 16.4183 4 12M20 12C20 14.5264 18.8289 16.7792 17 18.2454" stroke="#e0e2e5" stroke-width="1.5" stroke-linecap="round"></path> <path d="M12 14L12 4M12 4L15 7M12 4L9 7" stroke="#e0e2e5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                     Export
                </button>
            </div>
        </div>

        <!-- User Table -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <!-- Search Bar -->
                <div class="flex justify-end mb-4">
                    <input
                        type="text"
                        id="userSearch"
                        placeholder="Search users..."
                        class="border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue w-64"
                        onkeyup="filterUserTable()"
                    >
                </div>

                <table class="min-w-full divide-y divide-pam-gray-light" id="userTable">
                    <thead class="bg-pam-gray-light">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Contact Information</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Role</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-pam-gray uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-pam-gray-light">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-pam-gray-light flex items-center justify-center text-pam-blue font-medium">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-pam-blue">{{ $user->name }}</div>
                                            <div class="text-sm text-pam-gray">Registered: {{ $user->created_at->format('d M Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-pam-blue">{{ $user->email }}</div>
                                    <div class="text-sm text-pam-gray phone-number">{{ $user->phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pam-green text-white">
                                        {{ $user->is_active }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-pam-gray">
                                    {{ $user->role }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <!-- Call User Button -->
                                        <button onclick="callUser(this.closest('tr').querySelector('.phone-number').textContent.trim())" 
                                            class="text-pam-orange hover:text-pam-orange-light" title="Call User">
                                            <svg width="24px" height="24px" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                            <g><path class="cls-1" fill="#ff7900" d="M23,17.11a5.92,5.92,0,0,0-4.63-3.95,1.5,1.5,0,0,0-1.51.66L15.6,15.63a.53.53,0,0,1-.61.2,13.25,13.25,0,0,1-3.6-2.14,13,13,0,0,1-2.94-3.52.5.5,0,0,1,.17-.69l1.63-1.09a1.52,1.52,0,0,0,.61-1.71A10.13,10.13,0,0,0,9.48,3.79a10.36,10.36,0,0,0-2.2-2.33A1.53,1.53,0,0,0,6,1.19a7.31,7.31,0,0,0-1.13.43A7.64,7.64,0,0,0,1.2,6.1a1.48,1.48,0,0,0,0,.93A24.63,24.63,0,0,0,7.73,17.44,24.76,24.76,0,0,0,17.12,23a1.41,1.41,0,0,0,.45.07,1.59,1.59,0,0,0,.48-.07,7.64,7.64,0,0,0,4.47-3.66A6.21,6.21,0,0,0,23,18,1.46,1.46,0,0,0,23,17.11Zm-1.33,1.74A6.61,6.61,0,0,1,17.73,22a.54.54,0,0,1-.31,0,23.61,23.61,0,0,1-9-5.29,23.74,23.74,0,0,1-6.27-10,.47.47,0,0,1,0-.31A6.59,6.59,0,0,1,5.29,2.52a5,5,0,0,1,1-.36h.1a.5.5,0,0,1,.32.11,9.4,9.4,0,0,1,2,2.09A9.07,9.07,0,0,1,9.9,7a.52.52,0,0,1-.21.6L8.06,8.64a1.54,1.54,0,0,0-.47,2,14.09,14.09,0,0,0,7,6.09,1.51,1.51,0,0,0,1.81-.58l1.21-1.81a.51.51,0,0,1,.51-.23A4.94,4.94,0,0,1,22,17.44a.58.58,0,0,1,0,.29A5.35,5.35,0,0,1,21.62,18.85Z"></path></g>
                                            </svg>
                                        </button>

                                        <!-- Assign Role Button -->
                                        <button onclick="openRoleModal({{ $user->id }}, '{{ addslashes($user->name) }}')" class="text-pam-blue-light hover:text-pam-blue" title="Assign Role">
                                            <svg width="24px" height="24px" fill="#3d3bb0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" stroke="#3d3bb0">
                                            <g><path d="M44,63.3c0-3.4,1.1-7.2,2.9-10.2c2.1-3.7,4.5-5.2,6.4-8c3.1-4.6,3.7-11.2,1.7-16.2c-2-5.1-6.7-8.1-12.2-8 s-10,3.5-11.7,8.6c-2,5.6-1.1,12.4,3.4,16.6c1.9,1.7,3.6,4.5,2.6,7.1c-0.9,2.5-3.9,3.6-6,4.6c-4.9,2.1-10.7,5.1-11.7,10.9 c-1,4.7,2.2,9.6,7.4,9.6h21.2c1,0,1.6-1.2,1-2C45.8,72.7,44,68.1,44,63.3z M64,48.3c-8.2,0-15,6.7-15,15s6.7,15,15,15s15-6.7,15-15 S72.3,48.3,64,48.3z M66.6,64.7c-0.4,0-0.9-0.1-1.2-0.2l-5.7,5.7c-0.4,0.4-0.9,0.5-1.2,0.5c-0.5,0-0.9-0.1-1.2-0.5 c-0.6-0.6-0.6-1.7,0-2.5l5.7-5.7c-0.1-0.4-0.2-0.7-0.2-1.2c-0.2-2.6,1.9-5,4.5-5c0.4,0,0.9,0.1,1.2,0.2c0.2,0,0.2,0.2,0.1,0.4 L66,58.9c-0.2,0.1-0.2,0.5,0,0.6l1.7,1.7c0.2,0.2,0.5,0.2,0.7,0l2.5-2.5c0.1-0.1,0.4-0.1,0.4,0.1c0.1,0.4,0.2,0.9,0.2,1.2 C71.6,62.8,69.4,64.9,66.6,64.7z"></path></g>
                                            </svg>
                                        </button>

                                        <a href="{{ route('admin.users.show', $user->id) }}" class="text-pam-blue-light hover:text-pam-blue" title="View User">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="none" viewBox="0 0 24 24" stroke="#3d3bb0">
                                                <path stroke="#3d3bb0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M1.75 12S5 5.75 12 5.75 22.25 12 22.25 12 19 18.25 12 18.25 1.75 12 1.75 12Z"/>
                                                <circle cx="12" cy="12" r="3" stroke="#3d3bb0" stroke-width="2"/>
                                            </svg>
                                        </a>

                                        <!-- Suspend Account Button -->
                                        <button onclick="openSuspendModal({{ $user->id }}, '{{ addslashes($user->name) }}')" class="text-pam-red hover:text-pam-red-light" title="Suspend Account">
                                            <svg fill="#d81313" width="24px" height="24px" viewBox="-5 0 32 32" xmlns="http://www.w3.org/2000/svg" stroke="#d81313">
                                            <g><path d="M20.344 9.594c3.063 4.344 2.656 10.438-1.25 14.344s-9.938 4.281-14.313 1.25c-0.5-0.375-1.063-0.813-1.531-1.25-0.469-0.469-0.875-1-1.219-1.531-3.063-4.344-2.688-10.438 1.219-14.344s9.969-4.281 14.344-1.25c0.5 0.375 1.031 0.813 1.5 1.25 0.469 0.469 0.906 1 1.25 1.531zM4.031 20.375l11.563-11.563c-3.25-1.969-7.563-1.563-10.344 1.219-2.813 2.813-3.188 7.125-1.219 10.344zM18.344 11.625l-11.563 11.531c3.25 1.969 7.563 1.563 10.344-1.219 2.813-2.813 3.188-7.094 1.219-10.313z"></path></g>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <script>
                function filterUserTable() {
                    const input = document.getElementById('userSearch');
                    const filter = input.value.toLowerCase();
                    const table = document.getElementById('userTable');
                    const trs = table.getElementsByTagName('tr');

                    for (let i = 1; i < trs.length; i++) { // skip header row
                        const tds = trs[i].getElementsByTagName('td');
                        let rowText = '';
                        for (let j = 0; j < tds.length - 1; j++) { // exclude actions column
                            rowText += tds[j].textContent.toLowerCase() + ' ';
                        }
                        if (rowText.indexOf(filter) > -1) {
                            trs[i].style.display = '';
                        } else {
                            trs[i].style.display = 'none';
                        }
                    }
                }
                </script>
            </div>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-right justify-between border-t border-pam-gray-light sm:px-6 mt-4 rounded-b-lg">
            <div class="hidden spacing-4  sm:flex-1 sm:flex sm:items-center sm:justify-between">
                  {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Role Assignment Modal -->
    <div id="roleModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg max-w-md w-full p-6 mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-pam-blue" id="roleModalTitle">Assign Role</h3>
                <button onclick="closeRoleModal()" class="text-pam-gray hover:text-pam-blue">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="roleForm" >
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-pam-gray mb-1">Select Role</label>
                    <select id="userRole" name="role" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                        <option value="">Select a role</option>
                        <option value="rider">Rider</option>
                        <option value="vendor">Vendor</option>
                        <option value="operator">Operator</option>
                        <option value="unassigned">Unassigned</option>
                    </select>
                </div>
               
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeRoleModal()" class="bg-white py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-gray hover:bg-pam-gray-light">
                        Cancel
                    </button>
                    <button type="submit" class="bg-pam-blue py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-pam-blue-light">
                        Save Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Suspend Account Modal -->
    <div id="suspendModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg max-w-md w-full p-6 mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-pam-red" id="suspendModalTitle">Suspend Account</h3>
                <button onclick="closeSuspendModal()" class="text-pam-gray hover:text-pam-blue">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="suspendForm">
                <input type="hidden" id="suspendUserId">
                <div class="mb-4">
                    <p class="text-pam-gray mb-4">Are you sure you want to suspend this account?</p>
                    <label class="block text-sm font-medium text-pam-gray mb-1">Reason (Optional)</label>
                    <select id="suspendReason" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue mb-2">
                        <option value="">Select a reason</option>
                        <option value="inactivity">Account Inactivity</option>
                        <option value="violation">Terms Violation</option>
                        <option value="fraud">Suspected Fraud</option>
                        <option value="other">Other</option>
                    </select>
                    <textarea id="suspendDetails" rows="3" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue" placeholder="Additional details..."></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeSuspendModal()" class="bg-white py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-gray hover:bg-pam-gray-light">
                        Cancel
                    </button>
                    <button type="submit" class="bg-pam-red py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-pam-red-light">
                        Suspend Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
       
    function openAddUserModal() {
        document.getElementById('addUserModal').classList.remove('hidden');
    }
    function closeAddUserModal() {
        document.getElementById('addUserModal').classList.add('hidden');
    }
    // document.getElementById('addUserForm').addEventListener('submit', function(e) {
    //     e.preventDefault();
    //     // In a real app, you would make an AJAX call here
    //     alert('User added!');
    //     closeAddUserModal();
    //     // Optionally, refresh the table or update the UI
    // });
      
        // Call User Functionality
        function callUser(phoneNumber) {
            try {
                // Clean the phone number (remove all non-digit characters except +)
                const cleanNumber = phoneNumber.replace(/[^\d+]/g, '');
                
                // Validate phone number
                if (!cleanNumber) {
                    throw new Error('No phone number provided');
                }
                
                if (!/^\+?[\d]+$/.test(cleanNumber)) {
                    throw new Error('Invalid phone number format');
                }
                
                // Check if it's a mobile device
                const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
                
                if (isMobile) {
                    // On mobile - initiate call immediately
                    window.location.href = `tel:${cleanNumber}`;
                } else {
                    // On desktop - show options
                    const callWindow = window.open('', '_blank');
                    callWindow.document.write(`
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>Call ${phoneNumber}</title>
                            <style>
                                body { font-family: Arial, sans-serif; padding: 20px; }
                                .call-options { display: flex; gap: 10px; margin-top: 20px; }
                                .btn { padding: 8px 12px; color: white; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; }
                                .copy-btn { background: #3b82f6; }
                                .skype-btn { background: #00AFF0; }
                                .zoom-btn { background: #2D8CFF; }
                            </style>
                        </head>
                        <body>
                            <h2>Call Options</h2>
                            <p>Number: <strong>${phoneNumber}</strong></p>
                            <div class="call-options">
                                <button class="btn copy-btn" onclick="navigator.clipboard.writeText('${phoneNumber}')">
                                    Copy Number
                                </button>
                                <a href="skype:${cleanNumber}?call" class="btn skype-btn">
                                    Open Skype
                                </a>
                                <a href="zoomphone:${cleanNumber}" class="btn zoom-btn">
                                    Open Zoom
                                </a>
                            </div>
                        </body>
                        </html>
                    `);
                }
            } catch (error) {
                console.error('Call failed:', error);
                alert(`Could not initiate call: ${error.message}`);
            }
        }

        // Role Modal Functions
        function openRoleModal(userId, userName) {
            // document.getElementById('userId').value = userId;
            // document.getElementById('roleModalTitle').textContent = `Assign Role to ${userName}`;
            document.getElementById('roleModal').classList.remove('hidden');
        }

        function closeRoleModal() {
            document.getElementById('roleModal').classList.add('hidden');
        }

        
        
    </script>
</body>
</html>

</x-admin-nav>