<footer class="bg-[#111827] text-white pt-12 pb-6 border-t border-[#1F2937]">
    <div class="max-w-screen-xl mx-auto px-4">
        {{-- Top Section: Logo + Intro + Social + Stats --}}
        <div class="grid md:grid-cols-2 gap-8 items-center text-center md:text-left">
            {{-- Logo + Intro --}}
            <div>
                <img src="{{ asset('images/logo-choso.png') }}" alt="Choso Logo" class="h-10 mb-4 mx-auto md:mx-0">
                <p class="text-[#9CA3AF] text-sm max-w-md">
                    Nền tảng sản phẩm số chuyên nghiệp cho người bán Việt Nam. Choso giúp bạn dễ dàng kinh doanh, chia sẻ tri thức và tạo thu nhập bền vững.
                </p>
            </div>

            {{-- Social + Stats --}}
            <div class="space-y-4">
                {{-- Social --}}
                <div class="flex justify-center md:justify-end space-x-3">
                    <a href="#" class="bg-[#1F2937] p-2 rounded hover:bg-[#00BFA5] transition"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="bg-[#1F2937] p-2 rounded hover:bg-[#00BFA5] transition"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" class="bg-[#1F2937] p-2 rounded hover:bg-[#00BFA5] transition"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>

        {{-- Footer Links Section --}}
        <div class="grid grid-cols-2 md:grid-cols-3 gap-8 mt-12 text-sm">
            <div>
                <h4 class="font-bold text-white mb-3 border-b-2 border-[#00BFA5] inline-block">COMPANY</h4>
                <ul class="space-y-2 text-[#9CA3AF]">
                    <li><a href="#" class="hover:text-white">Về Choso</a></li>
                    <li><a href="#" class="hover:text-white">Tuyển dụng</a></li>
                    <li><a href="#" class="hover:text-white">Liên hệ</a></li>
                    <li><a href="#" class="hover:text-white">Báo chí</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-white mb-3 border-b-2 border-[#00BFA5] inline-block">LEGAL</h4>
                <ul class="space-y-2 text-[#9CA3AF]">
                    <li><a href="#" class="hover:text-white">Chính sách bảo mật</a></li>
                    <li><a href="#" class="hover:text-white">Điều khoản sử dụng</a></li>
                    <li><a href="#" class="hover:text-white">Cookies</a></li>
                    <li><a href="#" class="hover:text-white">Bản quyền</a></li>
                </ul>
            </div>

            <div class="col-span-2 md:col-span-1">
                <h4 class="font-bold text-white mb-3 border-b-2 border-[#00BFA5] inline-block">SUPPORT</h4>
                <ul class="space-y-2 text-[#9CA3AF]">
                    <li><a href="#" class="hover:text-white">Trung tâm hỗ trợ</a></li>
                    <li><a href="#" class="hover:text-white">Dịch vụ khách hàng</a></li>
                    <li><a href="#" class="hover:text-white">Câu hỏi thường gặp</a></li>
                    <li><a href="#" class="hover:text-white">Báo lỗi hệ thống</a></li>
                </ul>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="mt-12 text-center text-xs text-[#9CA3AF]">
            © {{ now()->year }} Choso.io – All rights reserved.
        </div>
    </div>
</footer>