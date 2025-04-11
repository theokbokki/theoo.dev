<?php

namespace App\Hiker\Resources\Notes;

use Hiker\Tracks\FlowsRepository;
use Hiker\Tracks\Roadmap;

class NoteFlows extends FlowsRepository
{
    /**
     * Returns the "draft" roadmap definition.
     * Draft is only used by graphical UI clients and is used to prepare
     * a flow's initial value(s).
     */
    public function draft(): Roadmap
    {
        return roadmap()
            ->show(Forms\NoteForm::class)
            ->chain('create');
    }

    /**
     * Returns the "create" roadmap definition.
     * Create is used by all clients (API included) for instanciating
     * a concrete flow with its initial value(s).
     */
    public function create(): Roadmap
    {
        return roadmap()
            ->save(Nodes\SaveNote::class)
            ->chain('read');
    }

    /**
     * Returns the "edit" roadmap definition.
     * Edit is only used by graphical UI clients and is used to prepare
     * a flow's updated value(s).
     */
    public function edit(): Roadmap
    {
        return roadmap()
            ->show(Forms\NoteForm::class)
            ->chain('update');
    }

    /**
     * Returns the "update" roadmap definition.
     * Update is used by all clients (API included) for setting
     * new values in a concrete flow.
     */
    public function update(): Roadmap
    {
        return roadmap()
            ->save(Nodes\SaveNote::class)
            ->chain('read');
    }

    /**
     * Returns the "read" (single resource) roadmap definition.
     * Read is used by all clients (API included) for displaying
     * or returning a flow's content.
     */
    public function read(): Roadmap
    {
        return roadmap()
            ->show(Views\SingleView::class);
    }

    /**
     * Returns the "delete" roadmap definition.
     * Delete is used by all clients (API included) for destroying
     * a flow and its related contents.
     */
    public function delete(): Roadmap
    {
        return roadmap()
            ->delete(Nodes\DeleteNote::class)
            ->chain('index');
    }
}
