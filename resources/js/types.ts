export interface CinematicUniverse {
    id: number | undefined;
    name: string;
    description: string | null;
    foundationYear: string;
}

export interface Movie {
    id: number;
    cinematic_universe_id: number;
    title: string;
    releaseDate: string;
    director: string;
    boxOfficeEarnings: number;
}

export interface Actor {
    id: number;
    name: string;
    dateOfBirth: string | null;
    nationality: string | null;
}

export interface Character {
    id: number;
    name: string;
    alias: string | null;
    superpowers: string | null;
    firstAppearance: string | null;
    actor: Actor;
}
