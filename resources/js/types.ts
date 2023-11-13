export interface CinematicUniverse {
    id: number;
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

export interface Character {
    id: number;
    movie_id: number;
    name: string;
    alias: string | null;
    superpowers: string | null;
    firstAppearance: string | null;
}
