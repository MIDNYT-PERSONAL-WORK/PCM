<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | PAM Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pam-blue': '#1e3a8a',
                        'pam-blue-light': '#3b82f6',
                        'pam-green': '#10b981',
                        'pam-red': '#ef4444',
                        'pam-gray': '#6b7280',
                        'pam-gray-light': '#f3f4f6',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="font-sans bg-pam-gray-light">
    <!-- Navigation -->


    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Profile Sidebar -->
            
            <div class="md:w-1/3">
                <a href="javascript:history.back()" class="bg-pam-gray-light text-pam-blue group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                    <i class="fas fa-arrow-left text-pam-blue mr-3"></i>
                    Back
                </a>
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="p-6 text-center">
                        <div class="mx-auto h-32 w-32 rounded-full bg-pam-gray-light flex items-center justify-center text-4xl font-bold text-pam-blue mb-4">
                            AD
                        </div>
                        <h2 class="text-xl font-bold text-pam-blue mb-1">{{auth()->user()->name}}</h2>
                        <p class="text-pam-gray mb-4">{{auth()->user()->email}}</p>
                        <p class="text-pam-gray text-sm">{{auth()->user()->role}} Account </p>
                    </div>
                    <div class="border-t border-pam-gray-light px-6 py-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-pam-gray">Member since</span>
                            <span class="font-medium">{{auth()->user()->created_at}}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-pam-gray">Last login</span>
                            <span class="font-medium">
                                {{
                                    optional(
                                        auth()->user()
                                            ->log()
                                            ->where('activity', 'User login Successful')
                                            ->latest('created_at')
                                            ->first()
                                    )?->created_at ?? 'N/A'
                                }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden mt-6">
                    <nav class="space-y-1 p-4">
                        <a href="#" class="bg-pam-gray-light text-pam-blue group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                            <i class="fas fa-user-circle text-pam-gray mr-3"></i>
                            Profile Information
                        </a>
                        <a href="#" class="text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                            <i class="fas fa-lock text-pam-gray mr-3"></i>
                            Change Password
                        </a>
                        <a href="#" class="text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                            <i class="fas fa-bell text-pam-gray mr-3"></i>
                            Notification Settings
                        </a>
                        <a href="javascript:history.back()" class="text-pam-gray hover:bg-pam-gray-light hover:text-pam-blue group flex items-center px-3 py-2 text-sm font-medium rounded-md">
                            <i class="fas fa-home text-pam-gray mr-3"></i>
                            Home
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="md:w-2/3">
                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="p-6 border-b border-pam-gray-light">
                        <h2 class="text-lg font-medium text-pam-blue">Profile Information</h2>
                        <p class="text-sm text-pam-gray mt-1">Update your account's profile information and email address.</p>
                    </div>

                    <form action="{{route('update.profile')}}" method="POST" class="p-6 space-y-6">
                         @csrf
                        {{-- <!-- Profile Photo -->
                        <div>
                            <label class="block text-sm font-medium text-pam-gray mb-1">Profile Photo</label>
                            <div class="flex items-center">
                                <div class="h-16 w-16 rounded-full bg-pam-gray-light flex items-center justify-center text-xl font-bold text-pam-blue mr-4">
                                    AD
                                </div>
                                <div>   
                                    <button type="button" class="bg-white py-2 px-3 border border-pam-gray-light rounded-md shadow-sm text-sm leading-4 font-medium text-pam-gray hover:bg-pam-gray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue">
                                        Select New Photo
                                    </button>
                                    <button type="button" class="ml-3 bg-white py-2 px-3 border border-transparent rounded-md shadow-sm text-sm leading-4 font-medium text-pam-red hover:text-pam-red-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div> --}}

                        <!-- Name -->
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-1" for="first-name">Full Name</label>
                            <input type="text" disabled id="full-name" value="{{ auth()->user()->name }}" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-1" for="email">Email</label>
                            <input type="text" name="email" id="email" value="" placeholder="{{ auth()->user()->email }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-1" for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" value="" placeholder="{{ auth()->user()->phone }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>

                        <!-- Vendor Association -->
                        {{-- <div>
                            <label class="block text-sm font-medium text-pam-gray mb-1">Vendor Association</label>
                            <div class="mt-1">
                                <select class="block w-full border border-pam-gray-light rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-pam-blue focus:border-pam-blue sm:text-sm">
                                    <option>MedEquip Nigeria</option>
                                    <option>Global Medical Supplies</option>
                                    <option>HealthPlus Nigeria</option>
                                </select>
                            </div>
                        </div> --}}

                        <!-- Bio -->
                        <div>
                            <label for="bio" class="block text-sm font-medium text-pam-gray mb-1">Bio</label>
                            <textarea id="bio" rows="3" class="mt-1 block w-full border border-pam-gray-light rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-pam-blue focus:border-pam-blue sm:text-sm">Vendor account manager for medical equipment and supplies.</textarea>
                        </div>

                        <div class="flex justify-end pt-4">
                            <div class="flex justify-end">
                                <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg mr-2 hover:bg-gray-300">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-indigo-700 hover:text-white">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Change Password -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden mt-6">
                    <div class="p-6 border-b border-pam-gray-light">
                        <h2 class="text-lg font-medium text-pam-blue">Change Password</h2>
                        <p class="text-sm text-pam-gray mt-1">Ensure your account is using a long, random password to stay secure.</p>
                    </div>

                    <form method="POST" action="{{route('update')}}" class="p-6 space-y-6">
                        <!-- Current Password -->
                        @csrf
                         <!-- Current Password -->
                        <div class="mb-4">
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="current_password" 
                                    name="current_password" 
                                    required
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('current_password') border-red-500 @enderror"
                                    placeholder="Enter current password"
                                >
                                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 toggle-password" data-target="current_password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    required
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary @error('password') border-red-500 @enderror"
                                    placeholder="Enter new password"
                                >
                                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 toggle-password" data-target="password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="mt-1 text-xs text-gray-500">
                                Password must be at least 8 characters long
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    required
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="Confirm new password"
                                >
                                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 toggle-password" data-target="password_confirmation">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <a href="javascript:history.back()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg mr-2 hover:bg-gray-300 transition duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-indigo-700 hover:text-white">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Account Deletion -->
                <div class="bg-white shadow-sm rounded-lg overflow-hidden mt-6 border border-pam-red-light">
                    <div class="p-6 border-b border-pam-gray-light">
                        <h2 class="text-lg font-medium text-pam-red">Delete Account</h2>
                        <p class="text-sm text-pam-gray mt-1">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    </div>

                    <div class="p-6">
                        <button type="button" id="deleteAccountBtn" class="bg-white py-2 px-4 border border-pam-red rounded-md shadow-sm text-sm font-medium text-pam-red hover:bg-pam-red hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-red">
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div id="deleteAccountModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg max-w-md w-full p-6 mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-pam-red">Delete Account</h3>
                <button id="closeDeleteModal" class="text-pam-gray hover:text-pam-blue">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <p class="text-pam-gray mb-6">Are you sure you want to delete your account? This action cannot be undone.</p>
            
            <form class="space-y-4">
                <div>
                    <label for="deletePassword" class="block text-sm font-medium text-pam-gray mb-1">Enter your password to confirm</label>
                    <input type="password" id="deletePassword" class="w-full border border-pam-gray-light rounded-md px-3 py-2 focus:ring-pam-blue focus:border-pam-blue">
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" id="cancelDeleteAccount" class="bg-white py-2 px-4 border border-pam-gray-light rounded-md shadow-sm text-sm font-medium text-pam-gray hover:bg-pam-gray-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-blue">
                        Cancel
                    </button>
                    <button type="submit" class="bg-pam-red py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-pam-red-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pam-red">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // User menu toggle
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        userMenuButton.addEventListener('click', () => {
            const expanded = userMenuButton.getAttribute('aria-expanded') === 'true';
            userMenuButton.setAttribute('aria-expanded', !expanded);
            userMenu.classList.toggle('hidden');
        });

        // Delete account modal
        const deleteAccountBtn = document.getElementById('deleteAccountBtn');
        const deleteAccountModal = document.getElementById('deleteAccountModal');
        const closeDeleteModal = document.getElementById('closeDeleteModal');
        const cancelDeleteAccount = document.getElementById('cancelDeleteAccount');

        deleteAccountBtn.addEventListener('click', () => {
            deleteAccountModal.classList.remove('hidden');
        });

        closeDeleteModal.addEventListener('click', () => {
            deleteAccountModal.classList.add('hidden');
        });

        cancelDeleteAccount.addEventListener('click', () => {
            deleteAccountModal.classList.add('hidden');
        });

        // Close modals when clicking outside
        window.addEventListener('click', (event) => {
            if (event.target === deleteAccountModal) {
                deleteAccountModal.classList.add('hidden');
            }
        });
    </script>
</body>
</html>