@extends('admin.layouts.app')

@section('title', 'Settings')
@section('page-title', 'System Settings')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6">
            @csrf

            <div class="space-y-6">
                <div class="border-b border-gray-200 pb-4">
                    <h3 class="text-lg font-semibold text-gray-800">General Settings</h3>
                    <p class="text-sm text-gray-500 mt-1">Configure general application settings</p>
                </div>

                <!-- Site Name -->
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                    <input type="text" 
                           name="settings[site_name]" 
                           id="site_name" 
                           value="{{ $settings['site_name']->value ?? '' }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142F32] focus:border-transparent">
                </div>

                <!-- Site Description -->
                <div>
                    <label for="site_description" class="block text-sm font-medium text-gray-700 mb-2">Site Description</label>
                    <textarea name="settings[site_description]" 
                              id="site_description" 
                              rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142F32] focus:border-transparent">{{ $settings['site_description']->value ?? '' }}</textarea>
                </div>

                <!-- Contact Email -->
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                    <input type="email" 
                           name="settings[contact_email]" 
                           id="contact_email" 
                           value="{{ $settings['contact_email']->value ?? '' }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142F32] focus:border-transparent">
                </div>

                <!-- Contact Phone -->
                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                    <input type="text" 
                           name="settings[contact_phone]" 
                           id="contact_phone" 
                           value="{{ $settings['contact_phone']->value ?? '' }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142F32] focus:border-transparent">
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea name="settings[address]" 
                              id="address" 
                              rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142F32] focus:border-transparent">{{ $settings['address']->value ?? '' }}</textarea>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Social Media</h3>
                    
                    <!-- Facebook -->
                    <div class="mb-4">
                        <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                        <input type="url" 
                               name="settings[facebook_url]" 
                               id="facebook_url" 
                               value="{{ $settings['facebook_url']->value ?? '' }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142F32] focus:border-transparent">
                    </div>

                    <!-- Twitter -->
                    <div class="mb-4">
                        <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-2">Twitter URL</label>
                        <input type="url" 
                               name="settings[twitter_url]" 
                               id="twitter_url" 
                               value="{{ $settings['twitter_url']->value ?? '' }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142F32] focus:border-transparent">
                    </div>

                    <!-- Instagram -->
                    <div>
                        <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                        <input type="url" 
                               name="settings[instagram_url]" 
                               id="instagram_url" 
                               value="{{ $settings['instagram_url']->value ?? '' }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#142F32] focus:border-transparent">
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="px-6 py-2 bg-[#142F32] text-white rounded-lg hover:bg-[#1a3f44] transition-colors">
                        Save Settings
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
