import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { fetchUniverseDetails } from '../services/UniverseService';

interface Movie {
    id: number;
    title: string;
    releaseDate: string;
}

interface UniverseDetails {
    id: number;
    name: string;
    description: string;
    movies: Movie[];
}

const UniversePage: React.FC = () => {
    const { id } = useParams<{ id: string }>();
    const [universeDetails, setUniverseDetails] = useState<UniverseDetails | null>(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');

    useEffect(() => {
        if (id) {
            fetchUniverseDetails(parseInt(id))
                .then(data => {
                    setUniverseDetails(data.data); // Update based on your API structure
                    setLoading(false);
                })
                .catch(err => {
                    console.error('Error fetching universe details:', err);
                    setError('Failed to load universe details');
                    setLoading(false);
                });
        }
    }, [id]);

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;

    return (
        <div>
            <h1>{universeDetails?.name}</h1>
            <p>{universeDetails?.description}</p>
                <div>
                    <h2>Movies Timeline</h2>
                    <h3>TODO: Add filtered movies to timeline</h3>
                </div>
        </div>
    );
};

export default UniversePage;
