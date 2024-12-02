<?php

namespace App\Controllers;

use App\Models\CalendarEventModel;

class Calendar extends BaseController
{
    protected $eventModel;
    public function __construct()
    {
        $this->eventModel = new CalendarEventModel();
    }
    public function index()
    {
        // Semua event
        $data['events'] = $this->eventModel->findAll();

        // Event untuk bulan dan tahun saat ini
        $currentMonth = date('m'); // Bulan saat ini (01-12)
        $currentYear = date('Y'); // Tahun saat ini (4 digit)

        $data['month_events'] = $this->eventModel
            ->where('MONTH(event_date)', $currentMonth)
            ->where('YEAR(event_date)', $currentYear)
            ->findAll();

        return view('/kalender', $data);
    }



    public function addEvent()
    {
        $eventModel = new CalendarEventModel();

        // Validasi input form
        $date = $this->request->getPost('date');
        $description = $this->request->getPost('description');

        // Simpan atau perbarui event berdasarkan tanggal
        if (empty($description)) {
            // Jika deskripsi kosong, hapus event yang ada
            $existingEvent = $eventModel->where('event_date', $date)->first();
            if ($existingEvent) {
                $eventModel->delete($existingEvent['id']);
            }
        } else {
            // Simpan atau perbarui event berdasarkan tanggal
            $existingEvent = $eventModel->where('event_date', $date)->first();
            if ($existingEvent) {
                // Perbarui jika event sudah ada
                $eventModel->update($existingEvent['id'], [
                    'event_description' => $description
                ]);
            } else {
                // Tambahkan event baru
                $eventModel->insert([
                    'event_date' => $date,
                    'event_description' => $description
                ]);
            }
        }

        // Redirect ke halaman kalender
        return redirect()->to('/calendar');
    }
}
