<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\CoSo;

class AIChatBotController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');

        $today = now()->toDateString();
        $coSoList = CoSo::with([
            'chuyenKhoa.bacSi.lichKham.lichKhamKhungGio.khungGio'
        ])->get();

        $info = "Thông tin tổng quan về các cơ sở, chuyên khoa và bác sĩ:\n";

        foreach ($coSoList as $coSo) {
            $info .= "- Cơ sở: {$coSo->tencoso}\n";

            foreach ($coSo->chuyenKhoa as $chuyenKhoa) {
                $info .= "  + Chuyên khoa: {$chuyenKhoa->tenkhoa}\n";

                foreach ($chuyenKhoa->bacSi as $bacSi) {
                    $info .= "    * Bác sĩ: {$bacSi->hocham} {$bacSi->hoten}\n";

                    foreach ($bacSi->lichKham as $lichKham) {
                        $info .= "      - Lịch khám: {$lichKham->ngaykham} ({$lichKham->buoi})\n";

                        foreach ($lichKham->lichKhamKhungGio as $khungGio) {
                            $thoiGian = $khungGio->khungGio->thoigianbatdau . ' - ' . $khungGio->khungGio->thoigianketthuc;
                            $info .= "          • Khung giờ: {$thoiGian}, SL tối đa: {$khungGio->soluongtoida}, Đã đặt: {$khungGio->soluongdadat}\n";
                        }
                    }
                }
            }
        }

        $info .= ' Lợi ích khi sử dụng ứng dụng đăng ký khám bệnh trực tuyến EbookCare là: Đặt lịch khám bệnh dễ dàng và thuận tiện, mọi lúc, mọi nơi.
                                       Loại bỏ thời gian đứng xếp hàng chờ đợi.
                                        Giảm thời gian chờ đợi tại bệnh viện.
                                        Tự do lựa chọn lịch khám (ngày, giờ, bác sĩ).';
        $info .= 'Đăng ký khám bệnh trực tuyến qua ứng dụng EbookCare có thu phí tiện ích khi đăng ký thành
                                    công.
                                    Điều này có nghĩa là bạn chỉ cần thanh toán phí khi đi khám tại cơ sở.
                                    Các tính năng khác của ứng dụng, bao gồm việc sử dụng ứng dụng và truy cập vào các thông
                                    tin khác, thì hoàn toàn miễn phí.';

        $info .= 'Ứng dụng EbookCare hỗ trợ đăng ký khám bệnh 24/7. Điều này có nghĩa là bạn có thể thực
                                    hiện việc đăng ký khám vào bất kỳ thời điểm nào trong ngày và bất kỳ ngày nào trong
                                    tuần.
                                    Đảm bảo rằng bạn có thể sử dụng ứng dụng để đăng ký khám bệnh mọi lúc mọi nơi, mà không
                                    cần phải đến trực tiếp bệnh viện để thực hiện.'
            . 'EbookCare cho phép tất cả người bệnh đều có thể sử dụng phần mềm để đăng ký khám bệnh trực
                                    tuyến (có khả năng tiếp cận và sử dụng phần mềm).

                                    Ứng dụng phù hợp cho những người bệnh có kế hoạch khám chữa bệnh chủ động, hoặc tình
                                    trạng bệnh KHÔNG quá khẩn cấp.

                                    Trong trường hợp CẤP CỨU, người nhà nên đưa người bệnh đến cơ sở y tế gần nhất hoặc gọi
                                    số cấp cứu 115 để được hỗ trợ kịp thời.'
            . ' Bạn có thể chủ động hủy phiếu khám đã đăng ký thành công, nếu kế hoạch khám chữa
                                    bệnh có sự thay đổi. Phí khám sẽ được hoàn trả theo đúng thời gian quy định.

                                    Hoặc trong một số trường hợp, bệnh viện có quyền từ chối phiếu khám, chẳng hạn như: sai
                                    lệch thông tin bệnh nhân, sai thông tin phiếu khám, hay vấn đề phát sinh bất khả kháng
                                    từ phía bệnh viện.

                                    Khi đó, bạn sẽ được hoàn tiền sau khi xác thực tình trạng sử dụng của phiếu khám, đảm
                                    bảo tuân thủ theo quy định của ứng dụng và bệnh viện.'
            . 'Trường hợp bạn đến trễ hơn so với giờ hẹn đã đặt khám bạn vẫn có thể được
                                    vào thăm khám tại bệnh viện. Tuy nhiên, mọi sự tiếp nhận và thời gian khám bệnh sẽ nghe
                                    theo sự sắp xếp của bệnh viện, phụ thuộc vào tình hình thực tế của bệnh viện ở thời điểm
                                    đó.'
            . ' Quy trình đặt lịch khám bệnh trực tuyến :  Đăng ký hoặc đăng nhập vào ứng dụng,
                                        Chọn cơ sở y tế và bác sĩ mong muốn,
                                        Chọn ngày và giờ khám phù hợp,
                                        Nhập thông tin bệnh nhân,
                                        Thanh toán trực tuyến và nhận xác nhận lịch khám,
                                        Đến bệnh viện đúng giờ để thực hiện khám.'
            . 'Bạn có thể đăng ký khám bệnh qua phần mềm, mọi lúc mọi nơi. Có thể đặt lịch hẹn khám
                                    bệnh trước ngày khám đến 30 ngày.'
            . '  Bạn không thể thay đổi thông tin khám trên phiếu khám bệnh đã đặt thành công.'
            . ' Thời gian bạn chọn khi đăng ký khám, được xem là thời gian khám bệnh dự kiến. Do đặc thù
                                    của công tác khám chữa bệnh, sẽ không thể chính xác thời gian khám 100%.'
            . 'Khi đã đặt khám trực tuyến trên hệ thống, bạn không còn phải xếp hàng chờ đợi để lấy số khám bệnh,
                                    bạn chỉ cần đến quầy thu ngân để thanh toàn tiền để được hướng dẫn vào phòng khám.';

        // Gửi đến OpenAI API
        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'Bạn là một trợ lý đặt lịch khám của ứng dụng EbookCare.'],
                ['role' => 'system', 'content' => "Hôm nay là ngày {$today}. Dưới đây là lịch khám trống cho hôm nay:\n" . $info],
                ['role' => 'user', 'content' => $message],
            ],
        ]);


        if ($response->failed()) {
            Log::error('OpenAI Error: ' . $response->body());
            return response()->json([
                'reply' => 'Lỗi từ máy chủ AI. Vui lòng thử lại sau.',
            ], 500);
        }

        return response()->json([
            'reply' => $response['choices'][0]['message']['content'] ?? 'Xin lỗi, tôi chưa hiểu câu hỏi của bạn.',
        ]);
    }
}
