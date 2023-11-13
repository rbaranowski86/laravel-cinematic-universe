import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { fetchCinematicUniverses } from '../services/UniverseService';

interface CinematicUniverse {
    id: number;
    name: string;
    description: string;
}

const HomePage: React.FC = () => {
    const [universes, setUniverses] = useState<CinematicUniverse[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');

    useEffect(() => {
        fetchCinematicUniverses()
            .then(universe => {
                // Assuming the response structure is { data: CinematicUniverse[] }
                setUniverses(universe); // Adjust based on actual response structure
                setLoading(false);
            })
            .catch(err => {
                console.error('Error fetching cinematic universes:', err);
                setError('Failed to load cinematic universes');
                setLoading(false);
            });
    }, []);

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;

    return (
        <div>
            <h1>Cinematic Universes</h1>
            <ul>
                {universes.map(universe => (
                    <li key={universe.id}>
                        <Link to={`/universe/${universe.id}`}>
                            {universe.name}
                        </Link>
                        <p>{universe.description}</p>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default HomePage;
