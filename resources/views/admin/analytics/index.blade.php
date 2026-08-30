@extends('admin.layouts.admin')

@section('title', 'Analytics Dashboard')

@section('content')
<div style="padding: 24px; max-width: 1200px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; flex-wrap: wrap; gap: 16px;">
        <h1 style="font-size: 24px; font-weight: 700; margin: 0; color: #111;">Analytics</h1>
        
        <form method="GET" action="{{ route('admin.analytics.index') }}" style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
            <select name="period" onchange="this.form.submit()" style="padding: 8px 12px; border: 1px solid #E5E7EB; border-radius: 6px; font-size: 14px; outline: none;">
                <option value="7" {{ $period == '7' ? 'selected' : '' }}>7 Hari Terakhir</option>
                <option value="30" {{ $period == '30' ? 'selected' : '' }}>30 Hari Terakhir</option>
                <option value="90" {{ $period == '90' ? 'selected' : '' }}>90 Hari Terakhir</option>
                <option value="custom" {{ $period == 'custom' ? 'selected' : '' }}>Periode Kustom</option>
            </select>

            @if($period == 'custom')
                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" style="padding: 8px 12px; border: 1px solid #E5E7EB; border-radius: 6px; font-size: 14px; outline: none;">
                <span style="color: #6B7280; font-weight: 600;">-</span>
                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" style="padding: 8px 12px; border: 1px solid #E5E7EB; border-radius: 6px; font-size: 14px; outline: none;">
                <button type="submit" style="background: #111; color: #fff; border: none; padding: 8px 16px; border-radius: 6px; font-weight: 600; cursor: pointer;">Terapkan</button>
            @endif
        </form>
    </div>

    {{-- Stats Cards --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px; margin-bottom: 32px;">
        <div style="background: #fff; border: 1px solid #E5E7EB; padding: 24px; border-radius: 12px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 48px; height: 48px; background: rgba(59,130,246,0.1); color: #3B82F6; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
                <div style="font-size: 13px; font-weight: 600; color: #6B7280; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Total Visitors</div>
                <div style="font-size: 28px; font-weight: 800; color: #111;">{{ number_format($visitors) }}</div>
            </div>
        </div>

        <div style="background: #fff; border: 1px solid #E5E7EB; padding: 24px; border-radius: 12px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 48px; height: 48px; background: rgba(34,197,94,0.1); color: #22C55E; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
            </div>
            <div>
                <div style="font-size: 13px; font-weight: 600; color: #6B7280; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Klik WhatsApp</div>
                <div style="font-size: 28px; font-weight: 800; color: #111;">{{ number_format($waClicks) }}</div>
            </div>
        </div>

        <div style="background: #fff; border: 1px solid #E5E7EB; padding: 24px; border-radius: 12px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 48px; height: 48px; background: rgba(168,85,247,0.1); color: #A855F7; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z"/><path d="M14 3v5h5M16 13H8M16 17H8M10 9H8"/></svg>
            </div>
            <div>
                <div style="font-size: 13px; font-weight: 600; color: #6B7280; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Total Leads</div>
                <div style="font-size: 28px; font-weight: 800; color: #111;">{{ number_format($leads) }}</div>
            </div>
        </div>
    </div>

    {{-- Daily Data Table --}}
    <div style="background: #fff; border: 1px solid #E5E7EB; border-radius: 12px; overflow: hidden;">
        <div style="padding: 20px 24px; border-bottom: 1px solid #E5E7EB; background: #F9FAFB;">
            <h2 style="margin: 0; font-size: 16px; font-weight: 700; color: #111;">Statistik Harian</h2>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: #fff; border-bottom: 2px solid #E5E7EB;">
                        <th style="padding: 16px 24px; font-size: 12px; font-weight: 700; color: #6B7280; text-transform: uppercase; letter-spacing: 1px;">Tanggal</th>
                        <th style="padding: 16px 24px; font-size: 12px; font-weight: 700; color: #6B7280; text-transform: uppercase; letter-spacing: 1px; text-align: center;">Visitors</th>
                        <th style="padding: 16px 24px; font-size: 12px; font-weight: 700; color: #6B7280; text-transform: uppercase; letter-spacing: 1px; text-align: center;">WA Clicks</th>
                        <th style="padding: 16px 24px; font-size: 12px; font-weight: 700; color: #6B7280; text-transform: uppercase; letter-spacing: 1px; text-align: center;">Leads</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(array_reverse($dailyData, true) as $date => $stats)
                    <tr style="border-bottom: 1px solid #E5E7EB; transition: background 150ms;" onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 16px 24px; font-size: 14px; font-weight: 600; color: #111;">{{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}</td>
                        <td style="padding: 16px 24px; font-size: 14px; color: #4B5563; text-align: center;">
                            @if($stats['visitor'] > 0)
                                <span style="background: rgba(59,130,246,0.1); color: #3B82F6; padding: 4px 12px; border-radius: 20px; font-weight: 700;">{{ $stats['visitor'] }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td style="padding: 16px 24px; font-size: 14px; color: #4B5563; text-align: center;">
                            @if($stats['wa_click'] > 0)
                                <span style="background: rgba(34,197,94,0.1); color: #22C55E; padding: 4px 12px; border-radius: 20px; font-weight: 700;">{{ $stats['wa_click'] }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td style="padding: 16px 24px; font-size: 14px; color: #4B5563; text-align: center;">
                            @if($stats['lead'] > 0)
                                <span style="background: rgba(168,85,247,0.1); color: #A855F7; padding: 4px 12px; border-radius: 20px; font-weight: 700;">{{ $stats['lead'] }}</span>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
