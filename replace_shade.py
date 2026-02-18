
import os

file_path = r'e:\dental\dental-main\resources\views\dental_lab_orders\edit.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

# Line numbers are 1-based in my analysis, but list is 0-based.
# I want to replace lines 325 to 883 (inclusive).
# So indices 324 to 883 (exclusive of end index in python slice? No. 324 is the 325th line.)
# lines[324] is line 325.
# lines[882] is line 883.
# So I want lines[:324] + new_content + lines[883:]

start_index = 324
end_index = 883 # This starts from line 884

new_content = r'''                                            <div class="col-6 m-0 p-0 border border-dark border-left-0">
                                                <div class="col-12 p-0 m-0">
                                                    <div class="row col-12 m-0 p-0 pt-0">
                                                        <div class="section-heading">
                                                            SHADE</div>
                                                        <div class="row col-12 p-1 m-0 justify-content-around">
                                                            <div class="col-4 m-0 p-0">
                                                                <table class="table" style="margin-bottom: 0;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-top: none; border-left: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_main_1" name="shade_main_1"
                                                                                    value="{{ old('shade_main_1', $dentalLabOrder->shade_main_1) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-top: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_1_1"
                                                                                    name="shade_left_1_1"
                                                                                    value="{{ old('shade_left_1_1', $dentalLabOrder->shade_left_1_1) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; min-width:22px !important; border: 1px dotted black; border-top: none; border-right: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_1_2"
                                                                                    name="shade_left_1_2"
                                                                                    value="{{ old('shade_left_1_2', $dentalLabOrder->shade_left_1_2) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-left: none;"
                                                                                class="p-0 text-center align-content-center">
                                                                                <span
                                                                                    style="position:absolute;left:-1px;top:38px; font-size: 10px;"
                                                                                    id="span_shade_left_1_3a">D</span><input
                                                                                    type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_1_3a"
                                                                                    name="shade_left_1_3a"
                                                                                    value="{{ old('shade_left_1_3a', $dentalLabOrder->shade_left_1_3a) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_1_3"
                                                                                    name="shade_left_1_3"
                                                                                    value="{{ old('shade_left_1_3', $dentalLabOrder->shade_left_1_3) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>

                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; min-width:22px !important; border: 1px dotted black; border-right: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_1_1"
                                                                                    name="shade_right_1_1"
                                                                                    value="{{ old('shade_right_1_1', $dentalLabOrder->shade_right_1_1) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; border-left: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_1_2"
                                                                                    name="shade_right_1_2"
                                                                                    value="{{ old('shade_right_1_2', $dentalLabOrder->shade_right_1_2) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; "
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_1_3"
                                                                                    name="shade_right_1_3"
                                                                                    value="{{ old('shade_right_1_3', $dentalLabOrder->shade_right_1_3) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; min-width:22px !important; border: 1px dotted black; border-bottom: none; border-right: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_2_4"
                                                                                    name="shade_right_2_4"
                                                                                    value="{{ old('shade_right_2_4', $dentalLabOrder->shade_right_2_4) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-4 m-0 p-0">
                                                                <table class="table" style="margin-bottom: 0;">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-top: none; border-left: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_main_2" name="shade_main_2"
                                                                                    value="{{ old('shade_main_2', $dentalLabOrder->shade_main_2) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-top: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_2_1"
                                                                                    name="shade_left_2_1"
                                                                                    value="{{ old('shade_left_2_1', $dentalLabOrder->shade_left_2_1) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center;min-width:22px !important; border: 1px dotted black; border-top: none; border-right: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_2_2"
                                                                                    name="shade_left_2_2"
                                                                                    value="{{ old('shade_left_2_2', $dentalLabOrder->shade_left_2_2) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;  border-left: none;"
                                                                                class="p-0 text-center align-content-center">
                                                                                <span id="span_shade_left_2_3a"
                                                                                    style="position:absolute;left:86px;top:38px; font-size: 10px;">M</span><input
                                                                                    type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_2_3a"
                                                                                    name="shade_left_2_3a"
                                                                                    value="{{ old('shade_left_2_3a', $dentalLabOrder->shade_left_2_3a) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_2_3"
                                                                                    name="shade_left_2_3"
                                                                                    value="{{ old('shade_left_2_3', $dentalLabOrder->shade_left_2_3) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>

                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center;min-width:22px !important; border: 1px dotted black; border-right: none;"
                                                                                class="p-0 text-center align-content-center">
                                                                                <span id="span_shade_left_2_3b"
                                                                                    style="position:absolute;right:0px;top:38px; font-size: 10px;">D</span><input
                                                                                    type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_left_2_3b"
                                                                                    name="shade_left_2_3b"
                                                                                    value="{{ old('shade_left_2_3b', $dentalLabOrder->shade_left_2_3b) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; border-left: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_2_1"
                                                                                    name="shade_right_2_1"
                                                                                    value="{{ old('shade_right_2_1', $dentalLabOrder->shade_right_2_1) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center; border: 1px dotted black; border-bottom: none; "
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_2_2"
                                                                                    name="shade_right_2_2"
                                                                                    value="{{ old('shade_right_2_2', $dentalLabOrder->shade_right_2_2) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                            <td style="width: 22px; height:22px; text-align: center;min-width:22px !important; border: 1px dotted black; border-bottom: none; border-right: none;"
                                                                                class="p-0">
                                                                                <input type="text"
                                                                                    style="width:22px; height:22px; font-size: 10px; padding: 1px;"
                                                                                    class="form-control px-0"
                                                                                    id="shade_right_2_3"
                                                                                    name="shade_right_2_3"
                                                                                    value="{{ old('shade_right_2_3', $dentalLabOrder->shade_right_2_3) }}"
                                                                                    {{ $isLaboratorist ? 'disabled' : '' }}>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 m-0 p-2" style="position: relative; bottom: 8px;">
                                                            @foreach (['top' => array_reverse(range(1, 8)), 'bottom' => range(1, 8)] as $position => $range)
                                                                {{-- This logic from user loop needs to be carefully handled as in edit blade it was explicit --}}
                                                            @endforeach
                                                            
                                                            <table class="table table-bordered border-dark" style="margin-bottom: 0; margin-top:2px;">
                                                                <tbody>
                                                                    <tr>
                                                                        @foreach (array_reverse(range(1, 8)) as $i)
                                                                        <td class="p-0 text-center" style="width: 24px; font-size: 10px; padding: 2px !important; background:{{ $dentalLabOrder->{'shade_d_top_' . $i} }};">
                                                                            {{ $i }}
                                                                            <input type="checkbox" name="shade_d_top_{{ $i }}" selected-color="" id="shade_d_top_{{ $i }}" style="padding: 0px; margin:0px; width: 12px; height: 12px;" {{ $isLaboratorist ? 'disabled' : '' }} value="{{ $dentalLabOrder->{'shade_d_top_' . $i} }}" {{ isset($dentalLabOrder->{'shade_d_top_' . $i}) && $dentalLabOrder->{'shade_d_top_' . $i} !== '' ? 'checked' : '' }}>
                                                                        </td>
                                                                        @endforeach
                                                                        @foreach (range(1, 8) as $i)
                                                                        <td class="p-0 text-center" style="width: 24px; font-size: 10px; padding: 2px !important; background:{{ $dentalLabOrder->{'shade_d_bottom_' . $i} }};">
                                                                            {{ $i }}
                                                                            <input type="checkbox" name="shade_d_bottom_{{ $i }}" selected-color="" id="shade_d_bottom_{{ $i }}" style="padding: 0px; margin:0px; width: 12px; height: 12px;" {{ $isLaboratorist ? 'disabled' : '' }} value="{{ $dentalLabOrder->{'shade_d_bottom_' . $i} }}" {{ isset($dentalLabOrder->{'shade_d_bottom_' . $i}) && $dentalLabOrder->{'shade_d_bottom_' . $i} !== '' ? 'checked' : '' }}>
                                                                        </td>
                                                                        @endforeach
                                                                    </tr>
                                                                    <tr>
                                                                        @foreach (array_reverse(range(1, 8)) as $i)
                                                                        <td class="p-0 text-center" style="width: 24px; font-size: 10px; padding: 2px !important; background:{{ $dentalLabOrder->{'shade_m_top_' . $i} }};">
                                                                            {{ $i }}
                                                                            <input type="checkbox" name="shade_m_top_{{ $i }}" selected-color="" id="shade_m_top_{{ $i }}" style="padding: 0px; margin:0px; width: 12px; height: 12px;" {{ $isLaboratorist ? 'disabled' : '' }} value="{{ $dentalLabOrder->{'shade_m_top_' . $i} }}" {{ isset($dentalLabOrder->{'shade_m_top_' . $i}) && $dentalLabOrder->{'shade_m_top_' . $i} !== '' ? 'checked' : '' }}>
                                                                        </td>
                                                                        @endforeach
                                                                        @foreach (range(1, 8) as $i)
                                                                        <td class="p-0 text-center" style="width: 24px; font-size: 10px; padding: 2px !important; background:{{ $dentalLabOrder->{'shade_m_bottom_' . $i} }};">
                                                                            {{ $i }}
                                                                            <input type="checkbox" name="shade_m_bottom_{{ $i }}" selected-color="" id="shade_m_bottom_{{ $i }}" style="padding: 0px; margin:0px; width: 12px; height: 12px;" {{ $isLaboratorist ? 'disabled' : '' }} value="{{ $dentalLabOrder->{'shade_m_bottom_' . $i} }}" {{ isset($dentalLabOrder->{'shade_m_bottom_' . $i}) && $dentalLabOrder->{'shade_m_bottom_' . $i} !== '' ? 'checked' : '' }}>
                                                                        </td>
                                                                        @endforeach
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
'''

final_content = lines[:start_index] + [new_content + "\n"] + lines[end_index:]

with open(file_path, 'w', encoding='utf-8') as f:
    f.writelines(final_content)
